<?php namespace GrahamCampbell\Queuing\Handlers;

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
 *
 * @package    Laravel-Queuing
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-Queuing
 */

use Illuminate\Support\Facades\Mail;

class MailHandler extends BaseHandler
{

    /**
     * Run the task (called by BaseHandler).
     *
     * @return void
     */
    protected function run()
    {
        $data = $this->data;
        if (!is_array($this->data['email'])) {
            $this->data['email'] = array($this->data['email']);
        }
        foreach ($this->data['email'] as $email) {
            $data['email'] = $email;
            Mail::send($data['view'], $data, function ($mail) use ($data) {
                $mail->to($data['email'])->subject($data['subject']);
            });
        }
    }
}
