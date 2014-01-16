<?php

/**
 * This file is part of Laravel Queuing by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Queuing\Models;

use Carbon\Carbon;
use GrahamCampbell\Core\Models\AbstractModel;

/**
 * This is the job model class.
 *
 * @package    Laravel-Queuing
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Queuing/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Queuing
 */
class Job extends AbstractModel
{
    /**
     * The table the jobs are stored in.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'job';

    /**
     * The model soft delete flag.
     *
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'tries', 'task');

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The page validation rules.
     *
     * @var array
     */
    public static $rules = array('task');

    /**
     * The page factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'    => 1,
        'tries' => 0,
        'task'  => 'GrahamCampbell\Queuing\Handlers\MailHandler'
    );

    /**
     * Get tries.
     *
     * @return int
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * Get task.
     *
     * @return string
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Get deleted.
     *
     * @return \Carbon\Carbon
     */
    public function getDeleted()
    {
        // TODO: Use the TraitDeletedModel from the Core package
        if ($this->deleted_at) {
            return true;
        }

        return false;
    }

    /**
     * Get deleted_at.
     *
     * @return \Carbon\Carbon
     */
    public function getDeletedAt()
    {
        // TODO: Use the TraitDeletedModel from the Core package
        if ($this->deleted_at) {
            return new Carbon($this->activated_at);
        }

        return null;
    }
}
