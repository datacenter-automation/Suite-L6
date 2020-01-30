/*
 *  Bootstrap Duallistbox - v4.0.1
 *  A responsive dual listbox widget optimized for Twitter Bootstrap. It works on all modern browsers and on touch devices.
 *  http://www.virtuosoft.eu/code/bootstrap-duallistbox/
 *
 *  Made by István Ujj-Mészáros
 *  Under Apache License v2.0 License
 */
(function(factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = function(root, jQuery) {
      if (jQuery === undefined) {
        if (typeof window !== 'undefined') {
          jQuery = require('jquery');
        }
        else {
          jQuery = require('jquery')(root);
        }
      }
      factory(jQuery);
      return jQuery;
    };
  } else {
    factory(jQuery);
  }
}(function($) {
  // Create the defaults once
  var pluginName = 'bootstrapDualListbox',
    defaults = {
      filterTextClear: 'show all',
      filterPlaceHolder: 'Filter',
      moveSelectedLabel: 'Move selected',
      moveAllLabel: 'Move all',
      removeSelectedLabel: 'Remove selected',
      removeAllLabel: 'Remove all',
      moveOnSelect: true,                                                                 // true/false (forced true on androids, see the comment later)
      moveOnDoubleClick: true,                                                            // true/false (forced false on androids, cause moveOnSelect is forced to true)
      preserveSelectionOnMove: false,                                                     // 'all' / 'moved' / false
      selectedListLabel: false,                                                           // 'string', false
      nonSelectedListLabel: false,                                                        // 'string', false
      helperSelectNamePostfix: '_helper',                                                 // 'string_of_postfix' / false
      selectorMinimalHeight: 100,
      showFilterInputs: true,                                                             // whether to show filter inputs
      nonSelectedFilter: '',                                                              // string, filter the non selected options
      selectedFilter: '',                                                                 // string, filter the selected options
      infoText: 'Showing all {0}',                                                        // text when all options are visible / false for no info text
      infoTextFiltered: '<span class="badge badge-warning">Filtered</span> {0} from {1}', // when not all of the options are visible due to the filter
      infoTextEmpty: 'Empty list',                                                        // when there are no options present in the list
      filterOnValues: false,                                                              // filter by selector's values, boolean
      sortByInputOrder: false,
      eventMoveOverride: false,                                                           // boolean, allows user to unbind default event behaviour and run their own instead
      eventMoveAllOverride: false,                                                        // boolean, allows user to unbind default event behaviour and run their own instead
      eventRemoveOverride: false,                                                         // boolean, allows user to unbind default event behaviour and run their own instead
      eventRemoveAllOverride: false,                                                      // boolean, allows user to unbind default event behaviour and run their own instead
      btnClass: 'btn-outline-secondary',                                                  // sets the button style class for all the buttons
      btnMoveText: '&gt;',                                                                // string, sets the text for the "Move" button
      btnRemoveText: '&lt;',                                                              // string, sets the text for the "Remove" button
      btnMoveAllText: '&gt;&gt;',                                                         // string, sets the text for the "Move All" button
      btnRemoveAllText: '&lt;&lt;'                                                        // string, sets the text for the "Remove All" button
    },
    // Selections are invisible on android if the containing select is styled with CSS
    // http://code.google.com/p/android/issues/detail?id=16922
    isBuggyAndroid = /android/i.test(navigator.userAgent.toLowerCase());

  // The actual plugin constructor
  function BootstrapDualListbox(element, options) {
    this.element = $(element);
    // jQuery has an extend method which merges the contents of two or
    // more objects, storing the result in the first object. The first object
    // is generally empty as we don't want to alter the default options for
    // future instances of the plugin
    this.settings = $.extend({}, defaults, options);
    this._defaults = defaults;
    this._name = pluginName;
    this.init();
  }

  function triggerChangeEvent(dualListbox) {
    dualListbox.element.trigger('change');
  }

  function updateSelectionStates(dualListbox) {
    dualListbox.element.find('option').each(function(index, item) {
      var $item = $(item);
      if (typeof($item.data('original-index')) === 'undefined') {
        $item.data('original-index', dualListbox.elementCount++);
      }
      if (typeof($item.data('_selected')) === 'undefined') {
        $item.data('_selected', false);
      }
    });
  }

  function changeSelectionState(dualListbox, original_index, selected) {
    dualListbox.element.find('option').each(function(index, item) {
      var $item = $(item);
      if ($item.data('original-index') === original_index) {
        $item.prop('selected', selected);
        if(selected){
          $item.attr('data-sortindex', dualListbox.sortIndex);
          dualListbox.sortIndex++;
        } else {
          $item.removeAttr('data-sortindex');
        }
      }
    });
  }

  function formatString(s, args) {
    console.log(s, args);
    return s.replace(/{(\d+)}/g, function(match, number) {
      return typeof args[number] !== 'undefined' ? args[number] : match;
    });
  }

  function refreshInfo(dualListbox) {
    if (!dualListbox.settings.infoText) {
      return;
    }

    var visible1 = dualListbox.elements.select1.find('option').length,
      visible2 = dualListbox.elements.select2.find('option').length,
      all1 = dualListbox.element.find('option').length - dualListbox.selectedElements,
      all2 = dualListbox.selectedElements,
      content = '';

    if (all1 === 0) {
      content = dualListbox.settings.infoTextEmpty;
    } else if (visible1 === all1) {
      content = formatString(dualListbox.settings.infoText, [visible1, all1]);
    } else {
      content = formatString(dualListbox.settings.infoTextFiltered, [visible1, all1]);
    }

    dualListbox.elements.info1.html(content);
    dualListbox.elements.box1.toggleClass('filtered', !(visible1 === all1 || all1 === 0));

    if (all2 === 0) {
      content = dualListbox.settings.infoTextEmpty;
    } else if (visible2 === all2) {
      content = formatString(dualListbox.settings.infoText, [visible2, all2]);
    } else {
      content = formatString(dualListbox.settings.infoTextFiltered, [visible2, all2]);
    }

    dualListbox.elements.info2.html(content);
    dualListbox.elements.box2.toggleClass('filtered', !(visible2 === all2 || all2 === 0));
  }

  function refreshSelects(dualListbox) {
    dualListbox.selectedElements = 0;

    dualListbox.elements.select1.empty();
    dualListbox.elements.select2.empty();

    dualListbox.element.find('option').each(function(index, item) {
      var $item = $(item);
      if ($item.prop('selected')) {
        dualListbox.selectedElements++;
        dualListbox.elements.select2.append($item.clone(true).prop('selected', $item.data('_selected')));
      } else {
        dualListbox.elements.select1.append($item.clone(true).prop('selected', $item.data('_selected')));
      }
    });

    if (dualListbox.settings.showFilterInputs) {
      filter(dualListbox, 1);
      filter(dualListbox, 2);
    }
    refreshInfo(dualListbox);
  }

  function filter(dualListbox, selectIndex) {
    if (!dualListbox.settings.showFilterInputs) {
      return;
    }

    saveSelections(dualListbox, selectIndex);

    dualListbox.elements['select'+selectIndex].empty().scrollTop(0);
    var regex,
      allOptions = dualListbox.element.find('option'),
      options = dualListbox.element;

    if (selectIndex === 1) {
      options = allOptions.not(':selected');
    } else  {
      options = options.find('option:selected');
    }

    try {
      regex = new RegExp($.trim(dualListbox.elements['filterInput'+selectIndex].val()), 'gi');
    }
    catch(e) {
      // a regex to match nothing
      regex = new RegExp('/a^/', 'gi');
    }

    options.each(function(index, item) {
      var $item = $(item),
        isFiltered = true;
      if (item.text.match(regex) || (dualListbox.settings.filterOnValues && $item.attr('value').match(regex) ) ) {
        isFiltered = false;
        dualListbox.elements['select'+selectIndex].append($item.clone(true).prop('selected', $item.data('_selected')));
      }
      allOptions.eq($item.data('original-index')).data('filtered'+selectIndex, isFiltered);
    });

    refreshInfo(dualListbox);
  }

  function saveSelections(dualListbox, selectIndex) {
    var options = dualListbox.element.find('option');
    dualListbox.elements['select'+selectIndex].find('option').each(function(index, item) {
      var $item = $(item);
      options.eq($item.data('original-index')).data('_selected', $item.prop('selected'));
    });
  }

  function sortOptionsByInputOrder(select){
    var selectopt = select.children('option');

    selectopt.sort(function(a,b){
      var an = parseInt(a.getAttribute('data-sortindex')),
          bn = parseInt(b.getAttribute('data-sortindex'));

          if(an > bn) {
             return 1;
          }
          if(an < bn) {
            return -1;
          }
          return 0;
    });

    selectopt.detach().appendTo(select);
  }

  function sortOptions(select) {
    select.find('option').sort(function(a, b) {
      return ($(a).data('original-index') > $(b).data('original-index')) ? 1 : -1;
    }).appendTo(select);
  }

  function clearSelections(dualListbox) {
    dualListbox.elements.select1.find('option').each(function() {
      dualListbox.element.find('option').data('_selected', false);
    });
  }

  function move(dualListbox) {
    if (dualListbox.settings.preserveSelectionOnMove === 'all' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
      saveSelections(dualListbox, 2);
    } else if (dualListbox.settings.preserveSelectionOnMove === 'moved' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
    }

    dualListbox.elements.select1.find('option:selected').each(function(index, item) {
      var $item = $(item);
      if (!$item.data('filtered1')) {
        changeSelectionState(dualListbox, $item.data('original-index'), true);
      }
    });

    refreshSelects(dualListbox);
    triggerChangeEvent(dualListbox);
    if(dualListbox.settings.sortByInputOrder){
        sortOptionsByInputOrder(dualListbox.elements.select2);
    } else {
        sortOptions(dualListbox.elements.select2);
    }
  }

  function remove(dualListbox) {
    if (dualListbox.settings.preserveSelectionOnMove === 'all' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
      saveSelections(dualListbox, 2);
    } else if (dualListbox.settings.preserveSelectionOnMove === 'moved' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 2);
    }

    dualListbox.elements.select2.find('option:selected').each(function(index, item) {
      var $item = $(item);
      if (!$item.data('filtered2')) {
        changeSelectionState(dualListbox, $item.data('original-index'), false);
      }
    });

    refreshSelects(dualListbox);
    triggerChangeEvent(dualListbox);
    sortOptions(dualListbox.elements.select1);
    if(dualListbox.settings.sortByInputOrder){
        sortOptionsByInputOrder(dualListbox.elements.select2);
    }
  }

  function moveAll(dualListbox) {
    if (dualListbox.settings.preserveSelectionOnMove === 'all' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
      saveSelections(dualListbox, 2);
    } else if (dualListbox.settings.preserveSelectionOnMove === 'moved' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
    }

    dualListbox.element.find('option').each(function(index, item) {
      var $item = $(item);
      if (!$item.data('filtered1')) {
        $item.prop('selected', true);
        $item.attr('data-sortindex', dualListbox.sortIndex);
        dualListbox.sortIndex++;
      }
    });

    refreshSelects(dualListbox);
    triggerChangeEvent(dualListbox);
  }

  function removeAll(dualListbox) {
    if (dualListbox.settings.preserveSelectionOnMove === 'all' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 1);
      saveSelections(dualListbox, 2);
    } else if (dualListbox.settings.preserveSelectionOnMove === 'moved' && !dualListbox.settings.moveOnSelect) {
      saveSelections(dualListbox, 2);
    }

    dualListbox.element.find('option').each(function(index, item) {
      var $item = $(item);
      if (!$item.data('filtered2')) {
        $item.prop('selected', false);
        $item.removeAttr('data-sortindex');
      }
    });

    refreshSelects(dualListbox);
    triggerChangeEvent(dualListbox);
  }

  function bindEvents(dualListbox) {
    dualListbox.elements.form.submit(function(e) {
      if (dualListbox.elements.filterInput1.is(':focus')) {
        e.preventDefault();
        dualListbox.elements.filterInput1.focusout();
      } else if (dualListbox.elements.filterInput2.is(':focus')) {
        e.preventDefault();
        dualListbox.elements.filterInput2.focusout();
      }
    });

    dualListbox.element.on('bootstrapDualListbox.refresh', function(e, mustClearSelections){
      dualListbox.refresh(mustClearSelections);
    });

    dualListbox.elements.filterClear1.on('click', function() {
      dualListbox.setNonSelectedFilter('', true);
    });

    dualListbox.elements.filterClear2.on('click', function() {
      dualListbox.setSelectedFilter('', true);
    });

    if (dualListbox.settings.eventMoveOverride === false) {
      dualListbox.elements.moveButton.on('click', function() {
        move(dualListbox);
      });
    }

    if (dualListbox.settings.eventMoveAllOverride === false) {
      dualListbox.elements.moveAllButton.on('click', function() {
        moveAll(dualListbox);
      });
    }

    if (dualListbox.settings.eventRemoveOverride === false) {
      dualListbox.elements.removeButton.on('click', function() {
        remove(dualListbox);
      });
    }

    if (dualListbox.settings.eventRemoveAllOverride === false) {
      dualListbox.elements.removeAllButton.on('click', function() {
        removeAll(dualListbox);
      });
    }

    dualListbox.elements.filterInput1.on('change keyup', function() {
      filter(dualListbox, 1);
    });

    dualListbox.elements.filterInput2.on('change keyup', function() {
      filter(dualListbox, 2);
    });
  }

  BootstrapDualListbox.prototype = {
    init: function () {
      // Add the custom HTML template
      this.container = $('' +
        '<div class="bootstrap-duallistbox-container row">' +
        ' <div class="box1 col-md-6">' +
        '   <label></label>' +
        '   <span class="info-container">' +
        '     <span class="info"></span>' +
        '     <button type="button" class="btn btn-sm clear1" style="float:right!important;"></button>' +
        '   </span>' +
        '   <input class="form-control filter" type="text">' +
        '   <div class="btn-group buttons">' +
        '     <button type="button" class="btn moveall"></button>' +
        '     <button type="button" class="btn move"></button>' +
        '   </div>' +
        '   <select multiple="multiple"></select>' +
        ' </div>' +
        ' <div class="box2 col-md-6">' +
        '   <label></label>' +
        '   <span class="info-container"