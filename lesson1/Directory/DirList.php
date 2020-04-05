<?php

function cmpSPLFileInfo( $splFileInfo1, $splFileInfo2 )
{
    //if ( $splFileInfo1->isDir() === $splFileInfo2->isDir() ) {
        return strcmp( $splFileInfo1->getFilename(), $splFileInfo2->getFilename() );
    //} else {
    //    return 0; //int( $splFileInfo1->isDir() > $splFileInfo2->isDir() );
    //}
}

class DirList extends DirectoryIterator
{
    private $dirArray;

    public function __construct( $p )
    {
        parent::__construct( $p );
        $this->dirArray = new ArrayObject();
        foreach( $this as $item )
        {
            //$this->dirArray->append( mb_convert_encoding($item, 'UTF-8', 'windows-1251') );
            $this->dirArray->append($item);
            
        }
        $this->dirArray->uasort( "cmpSPLFileInfo" );
    }

    public function getIterator()
    {
        return $this->dirArray->getIterator();
    }

}
?>