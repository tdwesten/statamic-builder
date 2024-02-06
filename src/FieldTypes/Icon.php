<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Icon extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'icon';

    protected $directory;

    protected $folder;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
            'directory' => $this->directory,
            'folder' => $this->folder,
        ]);
    }

    public function directory(string $directory)
    {
        $this->directory = $directory;

        return $this;
    }

    public function folder(string $folder)
    {
        $this->folder = $folder;

        return $this;
    }
}
