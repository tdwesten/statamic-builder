@extends('statamic::layout')
@section('title', __('Configure Collection'))

@section('content')
    <div class="card p-0 content dark:bg-dark-800">
        <div class="py-6 px-8 border-b dark:border-dark-900">
            <h1 class="dark:text-dark-100">{{ $type }} {{ 'not editable' }}</h1>
            <p class="dark:text-dark-400">{{ __("Because this $type is registered with the Statamic Builder it's only editable in PHP.") }}</p>
        </div>

        @if ($filePath)
            <div class="px-8 py-4 border-b dark:border-dark-900 bg-gray-50 dark:bg-dark-700/50">
                <div class="flex items-center text-xs font-mono text-gray-600 dark:text-dark-400">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="break-all">{{ $filePath }}</span>
                </div>
            </div>

            @if ($isLocal)
                <div class="flex flex-wrap p-4">
                    <a href="vscode://file/{{ $filePath }}"
                       class="w-full lg:w-1/2 p-4 flex items-start hover:bg-gray-200 dark:hover:bg-dark-600 rounded-md group">
                        <div class="h-8 w-8 mr-4 text-gray-800 dark:text-dark-100">
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="100"
                                    height="100">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M70.9119 99.3171C72.4869 99.9307 74.2828 99.8914 75.8725 99.1264L96.4608 89.2197C98.6242 88.1787 100 85.9892 100 83.5872V16.4133C100 14.0113 98.6243 11.8218 96.4609 10.7808L75.8725 0.873756C73.7862 -0.130129 71.3446 0.11576 69.5135 1.44695C69.252 1.63711 69.0028 1.84943 68.769 2.08341L29.3551 38.0415L12.1872 25.0096C10.589 23.7965 8.35363 23.8959 6.86933 25.2461L1.36303 30.2549C-0.452552 31.9064 -0.454633 34.7627 1.35853 36.417L16.2471 50.0001L1.35853 63.5832C-0.454633 65.2374 -0.452552 68.0938 1.36303 69.7453L6.86933 74.7541C8.35363 76.1043 10.589 76.2037 12.1872 74.9905L29.3551 61.9587L68.769 97.9167C69.3925 98.5406 70.1246 99.0104 70.9119 99.3171ZM75.0152 27.2989L45.1091 50.0001L75.0152 72.7012V27.2989Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#mask0)">
                                    <path
                                        d="M96.4614 10.7962L75.8569 0.875542C73.4719 -0.272773 70.6217 0.211611 68.75 2.08333L1.29858 63.5832C-0.515693 65.2373 -0.513607 68.0937 1.30308 69.7452L6.81272 74.754C8.29793 76.1042 10.5347 76.2036 12.1338 74.9905L93.3609 13.3699C96.086 11.3026 100 13.2462 100 16.6667V16.4275C100 14.0265 98.6246 11.8378 96.4614 10.7962Z"
                                        fill="#0065A9" />
                                    <g filter="url(#filter0_d)">
                                        <path
                                            d="M96.4614 89.2038L75.8569 99.1245C73.4719 100.273 70.6217 99.7884 68.75 97.9167L1.29858 36.4169C-0.515693 34.7627 -0.513607 31.9063 1.30308 30.2548L6.81272 25.246C8.29793 23.8958 10.5347 23.7964 12.1338 25.0095L93.3609 86.6301C96.086 88.6974 100 86.7538 100 83.3334V83.5726C100 85.9735 98.6246 88.1622 96.4614 89.2038Z"
                                            fill="#007ACC" />
                                    </g>
                                    <g filter="url(#filter1_d)">
                                        <path
                                            d="M75.8578 99.1263C73.4721 100.274 70.6219 99.7885 68.75 97.9166C71.0564 100.223 75 98.5895 75 95.3278V4.67213C75 1.41039 71.0564 -0.223106 68.75 2.08329C70.6219 0.211402 73.4721 -0.273666 75.8578 0.873633L96.4587 10.7807C98.6234 11.8217 100 14.0112 100 16.4132V83.5871C100 85.9891 98.6234 88.1786 96.4586 89.2196L75.8578 99.1263Z"
                                            fill="#1F9CF0" />
                                    </g>
                                    <g style="mix-blend-mode:overlay" opacity="0.25">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M70.8511 99.3171C72.4261 99.9306 74.2221 99.8913 75.8117 99.1264L96.4 89.2197C98.5634 88.1787 99.9392 85.9892 99.9392 83.5871V16.4133C99.9392 14.0112 98.5635 11.8217 96.4001 10.7807L75.8117 0.873695C73.7255 -0.13019 71.2838 0.115699 69.4527 1.44688C69.1912 1.63705 68.942 1.84937 68.7082 2.08335L29.2943 38.0414L12.1264 25.0096C10.5283 23.7964 8.29285 23.8959 6.80855 25.246L1.30225 30.2548C-0.513334 31.9064 -0.515415 34.7627 1.29775 36.4169L16.1863 50L1.29775 63.5832C-0.515415 65.2374 -0.513334 68.0937 1.30225 69.7452L6.80855 74.754C8.29285 76.1042 10.5283 76.2036 12.1264 74.9905L29.2943 61.9586L68.7082 97.9167C69.3317 98.5405 70.0638 99.0104 70.8511 99.3171ZM74.9544 27.2989L45.0483 50L74.9544 72.7012V27.2989Z"
                                            fill="url(#paint0_linear)" />
                                    </g>
                                </g>
                                <defs>
                                    <filter id="filter0_d" x="-8.39411" y="15.8291" width="116.727" height="92.2456"
                                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                        <feOffset />
                                        <feGaussianBlur stdDeviation="4.16667" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                        <feBlend mode="overlay" in2="BackgroundImageFix" result="effect1_dropShadow" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                            result="shape" />
                                    </filter>
                                    <filter id="filter1_d" x="60.4167" y="-8.07558" width="47.9167" height="116.151"
                                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                        <feOffset />
                                        <feGaussianBlur stdDeviation="4.16667" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                        <feBlend mode="overlay" in2="BackgroundImageFix" result="effect1_dropShadow" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                            result="shape" />
                                    </filter>
                                    <linearGradient id="paint0_linear" x1="49.9392" y1="0.257812" x2="49.9392"
                                        y2="99.7423" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="mb-2 text-blue dark:text-blue-400">{{ __('Edit in Visual Studio Code') }}</h3>
                            <p class="dark:text-dark-400">{{ __('Open this Blueprint in Visual Studio Code to edit it.') }}</p>
                        </div>
                    </a>
                    <a href="idea://open?file={{ $filePath }}"
                       class="w-full lg:w-1/2 p-4 flex items-start hover:bg-gray-200 dark:hover:bg-dark-600 rounded-md group">
                        <div class="h-8 w-8 mr-4 text-gray-800 dark:text-dark-100">
                            <!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 70 70"
                                style="enable-background:new 0 0 70 70;" xml:space="preserve">
                                <g>
                                    <g>
                                        <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="0.558"
                                            y1="46.8457" x2="29.9473" y2="8.0256">
                                            <stop offset="1.612903e-002" style="stop-color:#765AF8" />
                                            <stop offset="0.3821" style="stop-color:#B345F1" />
                                            <stop offset="0.7581" style="stop-color:#FA3293" />
                                            <stop offset="0.9409" style="stop-color:#FF318C" />
                                        </linearGradient>
                                        <polygon style="fill:url(#SVGID_1_);"
                                            points="39.6,15.2 36.3,5.2 11.9,0 0,13.5 37.2,32.5 		" />
                                        <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="2.7297"
                                            y1="48.3788" x2="32.0719" y2="9.6209">
                                            <stop offset="1.612903e-002" style="stop-color:#765AF8" />
                                            <stop offset="0.3821" style="stop-color:#B345F1" />
                                            <stop offset="0.7581" style="stop-color:#FA3293" />
                                            <stop offset="0.9409" style="stop-color:#FF318C" />
                                        </linearGradient>
                                        <polygon style="fill:url(#SVGID_2_);"
                                            points="28,41.4 27.3,20.6 0,13.5 6.7,53.6 28,53.4 		" />
                                        <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="50.8568"
                                            y1="46.405" x2="34.2739" y2="7.0481">
                                            <stop offset="0.1828" style="stop-color:#765AF8" />
                                            <stop offset="0.2382" style="stop-color:#8655F6" />
                                            <stop offset="0.3449" style="stop-color:#9F4CF3" />
                                            <stop offset="0.4425" style="stop-color:#AE47F2" />
                                            <stop offset="0.5219" style="stop-color:#B345F1" />
                                        </linearGradient>
                                        <polygon style="fill:url(#SVGID_3_);"
                                            points="22.1,41 23.4,24.5 43.2,4.2 60.9,7.4 70,30.1 60.5,39.5 45,37 35.4,47.1 		" />
                                        <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="63.2656"
                                            y1="57.3388" x2="24.6977" y2="27.5158">
                                            <stop offset="1.612903e-002" style="stop-color:#765AF8" />
                                            <stop offset="0.3821" style="stop-color:#B345F1" />
                                        </linearGradient>
                                        <polygon style="fill:url(#SVGID_4_);"
                                            points="43.2,4.2 14.8,29.4 20.3,61.8 43.9,70 70,54.4 		" />
                                    </g>
                                    <g>
                                        <rect x="13.4" y="13.4" style="fill:#000000;" width="43.2" height="43.2" />
                                        <rect x="17.5" y="48.5" style="fill:#FFFFFF;" width="16.2" height="2.7" />
                                        <path style="fill:#FFFFFF;"
                                            d="M17.3,19h7.3c4.3,0,6.9,2.5,6.9,6.2v0.1c0,4.2-3.2,6.3-7.3,6.3h-3l0,5.4h-3.9L17.3,19z M24.4,28
                                                                                                               c2,0,3.1-1.2,3.1-2.7v-0.1c0-1.8-1.2-2.7-3.2-2.7h-3V28H24.4z" />
                                        <path style="fill:#FFFFFF;"
                                            d="M32.5,34.4l2.3-2.8c1.6,1.3,3.3,2.2,5.4,2.2c1.6,0,2.6-0.6,2.6-1.7V32c0-1-0.6-1.5-3.6-2.3
                                                                                                               c-3.6-0.9-6-1.9-6-5.5v-0.1c0-3.3,2.6-5.4,6.3-5.4c2.6,0,4.9,0.8,6.7,2.3l-2.1,3c-1.6-1.1-3.2-1.8-4.7-1.8c-1.5,0-2.3,0.7-2.3,1.6
                                                                                                               v0.1c0,1.2,0.8,1.6,3.9,2.4c3.6,1,5.7,2.3,5.7,5.4v0.1c0,3.6-2.7,5.6-6.6,5.6C37.4,37.3,34.7,36.3,32.5,34.4" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="mb-2 text-blue dark:text-blue-400">{{ __('Edit in PhpStorm/IDEA') }}</h3>
                            <p class="dark:text-dark-400">{{ __('Open this Blueprint in PhpStorm/IDEA to edit it.') }}</p>
                        </div>
                    </a>
                </div>
            @endif
        @endif
    </div>
@stop
