@if($enabled)
  <div id="{{ $nameFieldName }}_wrap" style="display:none;">
    <input name="{{ $nameFieldName }}" type="hidden" value="" id="{{ $nameFieldName }}">
    <input name="{{ $validFromFieldName }}" type="hidden" value="{{ $encryptedValidFrom }}">
  </div>
@endif
