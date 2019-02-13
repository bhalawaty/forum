<?php
/**
 * Created by PhpStorm.
 * User: Bilal Halawaty
 * Date: 11-Feb-19
 * Time: 2:50 PM
 */

namespace App;


use phpDocumentor\Reflection\Types\Static_;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        foreach (static::getEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->createActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });


    }

    protected static function getEvents()
    {
        return ['created'];
    }

    protected function createActivity($event)
    {
        return $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return $event . '_' . $type;
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}