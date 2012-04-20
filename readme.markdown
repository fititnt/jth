PHP | Joomla | JTH (Joomla Template Helper)
================================================================================
For Joomla 2.5+

Minimalist helpers for use on Joomla Template Development

### About branches on this repository:

- **master**: *development branch. Unstable*
- **staging**: *test branch. Used before branch production/release for public test**
- **production**: *version accredited to be used on production. Can be a bit old.*

Author:

- Emerson Rocha Luiz	
- emerson at webdesign.eng.br
- http://fititnt.org

License:
	Massachusetts Institute of Technology. See license-mit.txt

Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights 
reserved.

How to use
--------------------------------------------------------------------------------
- Copy contents of jth to your template folder inside fo another folder, for 
example "subfoldername"
- Use file templatehelper.php as example of what must do for extends jth.php. 
Avoid hack jth.php, just do it on your extended class.
- On your index.php, add, for example,
<pre>
require_once '/subfoldername/templatehelper.php';
$jth = new JTemplateHelper($this);
//print_r($jth); //See comments on jth.php for description of default methods
</pre>


Instalation & Dependences
--------------------------------------------------------------------------------

Todo
--------------------------------------------------------------------------------

Changelog
--------------------------------------------------------------------------------
<pre>
- 2012-04-20
+ Added files, based on a private work from author.
! Still need some test

-2012-04-19
- removed all old files from old quickstart template

-2011-09-12
+ Added $jtp->load() : load object of the template
+ Added $jtp->poscount() : simple and multidimensional $this->countModules()

-2011-09-12: Initial release
! Created. Forked from joomleiros template from #jdbr11


CHANGELOG LEGEND:
+ Added
- Removed
^ Updated
* Bugfix
# Security Fix
! Relevant message
</pre>