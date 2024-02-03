<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\AssetsUIModeOption;

class Assets extends Field
{
    use Makeble;

    protected $type = 'assets';

    protected $icon = 'assets';

    protected $max_files;

    protected $min_files;

    protected $mode = AssetsUIModeOption::List;

    protected $container;

    protected $folder;

    protected $restrict;

    protected $allow_uploads;

    protected $show_filename;

    protected $show_set_alt;

    protected $query_scopes;

    public function __construct($handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_files' => $this->max_files,
            'min_files' => $this->min_files,
            'mode' => $this->mode->value,
            'container' => $this->container,
            'folder' => $this->folder,
            'restrict' => $this->restrict,
            'allow_uploads' => $this->allow_uploads,
            'show_filename' => $this->show_filename,
            'show_set_alt' => $this->show_set_alt,
            'query_scopes' => $this->query_scopes,
        ]);
    }

    public function maxFiles(int $maxFiles): self
    {
        $this->max_files = $maxFiles;

        return $this;
    }

    public function minFiles(int $minFiles): self
    {
        $this->min_files = $minFiles;

        return $this;
    }

    public function mode(AssetsUIModeOption $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function container(string $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function folder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function restrict(): self
    {
        $this->restrict = true;

        return $this;
    }

    public function allowUploads(): self
    {
        $this->allow_uploads = true;

        return $this;
    }

    public function showFilename(): self
    {
        $this->show_filename = true;

        return $this;
    }

    public function showSetAlt(): self
    {
        $this->show_set_alt = true;

        return $this;
    }

    public function queryScopes(array $queryScopes): self
    {
        $this->query_scopes = $queryScopes;

        return $this;
    }
}
