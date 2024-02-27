<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum BardButton: string
{
    case H2 = 'h2';
    case H3 = 'h3';
    case Bold = 'bold';
    case Italic = 'italic';
    case Unorderedlist = 'unorderedlist';
    case Orderedlist = 'orderedlist';
    case Removeformat = 'removeformat';
    case Quote = 'quote';
    case Anchor = 'anchor';
    case Image = 'image';
    case Table = 'table';
}
