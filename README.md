SilverStripe Private Assets
===========================
This module makes (some) assets only accessible to logged in users. Any file (not images or scripts) uploaded under `assets/private/**` will require login to be viewed/downloaded.

## Requirements
* [SilverStripe Framework 3.1](https://github.com/silverstripe/silverstripe-framework)

### Htaccess
Paste this in your root `.htaccess` file in the SilverStripe section, after the `RewriteBase '/'` line.

```apacheconf
RewriteCond %{REQUEST_URI} /assets/private [NC]
RewriteCond %{REQUEST_FILENAME} \.(pdf|zip|rar|7z|doc|docx|xls|xlsx|ppt|pptx)$ [NC]
RewriteRule .* privateassets?file=%{REQUEST_FILENAME}&%{QUERY_STRING} [L,NC]
```

## TODO
* a lot
* make this configarable through an admin

## License (BSD Simplified)

Copyright (c) 2013, Thierry Francois (colymba)

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * Neither the name of Thierry Francois, colymba nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
