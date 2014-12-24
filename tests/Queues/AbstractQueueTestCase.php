<?php

/*
 * This file is part of Laravel Queuing by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Queuing\Queues;

use GrahamCampbell\TestBench\AbstractTestCase;

/**
 * This is the abstract queue test case class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Queuing/blob/master/LICENSE.md> Apache 2.0
 */
abstract class AbstractQueueTestCase extends AbstractTestCase
{
    public function testPushAndProcess()
    {
        $queue = $this->getQueue();

        $this->assertNull($queue->push('foo', ['foodata']));
        $this->assertNull($queue->later(666, 'bar', ['bardata']));

        // process once - jobs are processed and unset
        $queue->process();

        // process again - nothing should happen
        $queue->process();
    }

    abstract protected function getQueue();
}
