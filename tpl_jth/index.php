<?php
/**
 * @package     JTH
 * @author      Joomla! Coders Brazil - @JCoderBR ( http://jcbr.github.com )
 * @copyright   Copyright (C) 2011 Joomla! Coders Brazil. All rights reserved.
 * @license     GPL3
 */
// no direct access
defined('_JEXEC') or die;

//Basic load of JTP
include_once 'jtp/jtp.php';
$jtp = new jtp;
$jtp->load($this);

?>

<!DOCTYPE HTML>
<html>
<head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/joomleiros/css/joomleiros.css" type="text/css" />
</head>

<body>
  <div id="all">
   <header class="row">
       <div class="column grid_12">
        <jdoc:include type="modules" name="topo" style="xhtml"/>
        </div>
        <nav class="row">
    <div class="column grid_12">   
        <jdoc:include type="modules" name="menu" style="xhtml"/>
    </div>
   </nav>
   </header>.
   <div class="row">
    <div class="column grid_12">
    <jdoc:include type="message" />
    </div>
   </div>
   <aside class="row">
       <div class="column grid_4">
            <jdoc:include type="modules" name="coluna1" style="xhtml"/>
        </div>
   </aside>
   <div id="row conteudo">
        <div class="column grid_8">
             <jdoc:include type="component" />
     </div>
   <aside class="row">
        <div class="column grid_4">
            <jdoc:include type="modules" name="coluna2" style="xhtml"/>
        </div>
   </aside>
   <footer class="row">
        <div class="column grid_12">
            <jdoc:include type="modules" name="rodape" style="xhtml"/>
        </div>
   </footer>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/joomleiros/js/joomleiros.js"></script>
   </footer>
  </div>
</body>
</html>