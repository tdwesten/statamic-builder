<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum CodeModeOption: string
{
    case C_Like = 'clike';
    case CSS = 'css';
    case Diff = 'diff';
    case Go = 'go';
    case HAML = 'haml';
    case Handlebars = 'handlebars';
    case HTML = 'htmlmixed';
    case LESS = 'less';
    case Markdown = 'markdown';
    case Markdown_Github_Flavored = 'gfm';
    case Nginx = 'nginx';
    case Java = 'text/x-java';
    case JavaScript = 'javascript';
    case JSX = 'jsx';
    case ObjectiveC = 'text/x-objectivec';
    case PHP = 'php';
    case Python = 'python';
    case Ruby = 'ruby';
    case SCSS = 'scss';
    case Shell = 'shell';
    case SQL = 'sql';
    case Twig = 'twig';
    case Vue = 'vue';
    case XML = 'xml';
    case YAML = 'yaml-frontmatter';
}
