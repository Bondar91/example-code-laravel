<?php

namespace App\Dhl\Structures;

class Piece
{
    private $pieceDefinition = [
        'type' => 'PACKAGE',
        'width' => 1,
        'height' => 1,
        'length' => 1,
        'weight' => 1,
        'quantity' => 1,
    ];

    /**
     * @return array
     */
    public function getPieceDefinition()
    {
        return $this->pieceDefinition;
    }
}
