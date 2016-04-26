<?php

/*
 * Laravel-Mns -- 阿里云消息队列（MNS）的 Laravel 适配。
 *
 * (c) Abraham Greyson <82011220@qq.com>
 *
 * @link: https://github.com/AbrahamGreyson/laravel-mns
 *
 * @license: MIT
 */

namespace Qufenqi\Queue\Connectors;

use AliyunMNS\Client as MnsClient;
use Config;
use Illuminate\Queue\Connectors\ConnectorInterface;
use Qufenqi\Queue\MnsAdapter;
use Qufenqi\Queue\MnsQueue;

/**
 * Class MnsConnector.
 */
class MnsConnector implements ConnectorInterface
{
    /**
     * Establish a queue connection.
     *
     * @param array $config
     *
     * @return \Illuminate\Queue\QueueInterface
     */
    public function connect(array $config)
    {
        $config = Config::get('queue.connections.mns');

        return new MnsQueue(
            new MnsAdapter(
                new MnsClient($config['endpoint'], $config['key'], $config['secret']),
                $config['queue']
            )
        );
    }
}
