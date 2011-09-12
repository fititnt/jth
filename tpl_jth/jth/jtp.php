<?php
/**
 * @package     JTH
 * @author      Joomla! Coders Brazil - @JCoderBR ( http://jcbr.github.com )
 * @copyright   Copyright (C) 2011 Joomla! Coders Brazil. All rights reserved.
 * @license     GPL3
 */
// no direct access
defined('_JEXEC') or die;

class jth {

    /*
     * @var     object      $tpl: template object
     */
    private $tpl;

    /*
     * @var     object      $templateObject: the '$this' object of the template
     */

    public function load( $templateObject )
    {
        $this->tpl = $templateObject;
        return $this;
    }

    /*
     * Abstrai o $this->countModules() padrao do Joomla e permite que ele faca pesquisa por arrays
     * multidimencionais, de modo que retorne a contagem de subitens que existirem
     *
     * @var     array       $colunas: array com colunas a serem pesquisadas. Pode ser multidimensional
     * @return  int         Se maior que 1, retorna numero, caso contrario retorna '';
     */
    public function poscount( $colunas )
    {
        if( !isset( $colunas[0][0] ) ){ //Its not multidimensional, so...
            for($coluna = $i = 0; $i < count($colunas); ++$i ){
                $coluna += $this->tpl->countModules( $colunas[$i] );
            }
        } else {
            for($coluna = $i = 0; $i < count($colunas); ++$i ){
                for( $flag = $j = 0; $j< count($colunas[$i]); ++$j ){
                    $flag += $this->tpl->countModules( $colunas[$i][$j] );
                }
                if ( $flag ){
                    ++$coluna;
                }
            }
        }
        if( ! $coluna > 0){
            $coluna = '';//Maybe return NULL?
        }
        return $coluna;
    }

}