<?php

return [

    'uploader_folder' => public_path() . '/img',

    'temp_folder' => '/temp',

    'fine_uploader' => [

        'allowed_extensions' => ['jpg', 'png'],
        'size_limit'    => 2*1024*1024, // 20 Mb
        'input_name'    => 'qqfile',
        'chunks_folder' => '/chunks'

    ],

    // Can be overridden by client
    'thumbnails' => [
        'height' => 100,
        'width' => 500,
        'crop' => 'fill'
    ],

    'storage' => 'local',

    'storage_url_resolver' => function($file) {
        return '/' . $file->getUploaderPath() . '/' . $file->getFilename();
    },

    'success_response_class' => Optimus\FineuploaderServer\Response\OptimusResponse::class,

    'storages' => [

        'local' => [
            'class' => Optimus\FineuploaderServer\Storage\LocalStorage::class,
            'config' => [
                'root_folder' => public_path() . '/img'
            ]
        ]

    ],

    'naming_strategy' => Optimus\FineuploaderServer\Naming\UniqidStrategy::class,

    'middleware' => [
        [
            'class' => Optimus\FineuploaderServer\Middleware\ThumbnailCreator::class,
            'config' => [

            ]
        ]
    ]

];
