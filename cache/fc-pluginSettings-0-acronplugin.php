<?php return array (
  'crontab' => 
  array (
    0 => 
    array (
      'className' => 'APP\\plugins\\generic\\pln\\classes\\tasks\\Depositor',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
        0 => 'autoStage',
      ),
    ),
    1 => 
    array (
      'className' => 'APP\\plugins\\importexport\\doaj\\DOAJInfoSender',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
    2 => 
    array (
      'className' => 'PKP\\task\\ReviewReminder',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
    3 => 
    array (
      'className' => 'PKP\\task\\StatisticsReport',
      'frequency' => 
      array (
        'day' => '1',
      ),
      'args' => 
      array (
      ),
    ),
    4 => 
    array (
      'className' => 'APP\\tasks\\SubscriptionExpiryReminder',
      'frequency' => 
      array (
        'day' => '1',
      ),
      'args' => 
      array (
      ),
    ),
    5 => 
    array (
      'className' => 'PKP\\task\\DepositDois',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
    6 => 
    array (
      'className' => 'PKP\\task\\RemoveUnvalidatedExpiredUsers',
      'frequency' => 
      array (
        'day' => '1',
      ),
      'args' => 
      array (
      ),
    ),
    7 => 
    array (
      'className' => 'PKP\\task\\EditorialReminders',
      'frequency' => 
      array (
        'day' => '1',
      ),
      'args' => 
      array (
      ),
    ),
    8 => 
    array (
      'className' => 'PKP\\task\\UpdateIPGeoDB',
      'frequency' => 
      array (
        'day' => '10',
      ),
      'args' => 
      array (
      ),
    ),
    9 => 
    array (
      'className' => 'APP\\tasks\\UsageStatsLoader',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
    10 => 
    array (
      'className' => 'PKP\\task\\ProcessQueueJobs',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
    11 => 
    array (
      'className' => 'PKP\\task\\RemoveFailedJobs',
      'frequency' => 
      array (
        'day' => '1',
      ),
      'args' => 
      array (
      ),
    ),
    12 => 
    array (
      'className' => 'APP\\tasks\\OpenAccessNotification',
      'frequency' => 
      array (
        'hour' => 24,
      ),
      'args' => 
      array (
      ),
    ),
  ),
  'enabled' => true,
);