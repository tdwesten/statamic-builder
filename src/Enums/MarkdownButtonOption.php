<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum MarkdownButtonOption: string
{
    case Bold = 'bold';
    case Italic = 'italic';
    case Unorderedlist = 'unorderedlist';
    case Orderedlist = 'orderedlist';
    case Quote = 'quote';
    case Link = 'link';
    case Image = 'image';
    case Table = 'table';

}
