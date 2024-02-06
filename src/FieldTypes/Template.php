<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Template extends Field
{
    use Makeble;

    protected $type = 'template';

    protected $hide_patails = true;

    protected $blueprint = true;

    protected $folder;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'hide_partials' => $this->hide_patails,
            'blueprint' => $this->blueprint,
            'folder' => $this->folder,
        ]);
    }

    public function hidePartials(bool $hide = true): self
    {
        $this->hide_patails = $hide;

        return $this;
    }

    public function blueprint(bool $blueprint = true): self
    {
        $this->blueprint = $blueprint;

        return $this;
    }

    public function folder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }
}
