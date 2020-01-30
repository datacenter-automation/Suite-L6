<?php

Route::resource('upload', 'UploadController')->except(['create', 'edit', 'update']);
