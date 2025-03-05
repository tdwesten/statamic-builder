<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\AssetsUIModeOption;
use Tdwesten\StatamicBuilder\Enums\DynamicFolderOption;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;

class Assets extends Field
{
    use Makeble;

    protected $type = 'assets';

    protected $max_files;

    protected $min_files;

    protected $mode = AssetsUIModeOption::List;

    protected $container;

    protected $folder;

    protected $dynamic;

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
            'dynamic' => $this->dynamic?->value,
            'restrict' => $this->restrict,
            'allow_uploads' => $this->allow_uploads,
            'show_filename' => $this->show_filename,
            'show_set_alt' => $this->show_set_alt,
            'query_scopes' => $this->query_scopes,
        ]);
    }

    public function maxFiles(int $maxFiles)
    {
        $this->max_files = $maxFiles;

        return $this;
    }

    public function minFiles(int $minFiles)
    {
        $this->min_files = $minFiles;

        return $this;
    }

    public function mode(AssetsUIModeOption $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function container(string $container)
    {
        $this->container = $container;

        return $this;
    }

    public function folder(string $folder)
    {
        $this->folder = $folder;

        return $this;
    }

    public function dynamic(DynamicFolderOption $dynamic)
    {
        $this->dynamic = $dynamic;

        return $this;
    }

    public function restrict()
    {
        $this->restrict = true;

        return $this;
    }

    public function allowUploads()
    {
        $this->allow_uploads = true;

        return $this;
    }

    public function showFilename()
    {
        $this->show_filename = true;

        return $this;
    }

    public function showSetAlt()
    {
        $this->show_set_alt = true;

        return $this;
    }

    public function queryScopes(array $queryScopes)
    {
        $this->query_scopes = $queryScopes;

        return $this;
    }

    public function validateField()
    {
        parent::validateField();

        if ($this->min_files && $this->max_files && $this->min_files > $this->max_files) {
            throw new BlueprintRenderException('min_files must be less than or equal to max_files');
        }

        if ($this->container === null || empty($this->container)) {
            throw new BlueprintRenderException('[ '.get_called_class().'] Field container cannot be empty');
        }

    }
}
