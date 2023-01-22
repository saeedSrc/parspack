<?php

namespace App\Listeners;

use App\Events\NewComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreCommentCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewComment  $event
     * @return void
     */
    public function handle(NewComment $event)
    {

        $pName = $event->pname;
        $fileName = "/opt/myprogram/product_comments";
        $output =  shell_exec("awk -F':' '$1 ==\"" . $pName . "\"{print $2}' " . $fileName);
        $oparray = preg_split('/\s+/', trim($output));
        $lastValue = $oparray[count($oparray) - 1];

        if ($lastValue == null ) {
            shell_exec("echo " . $pName . ": " . 1 . " >> " . $fileName);
        } else {
            shell_exec("sudo -S sed -i.bkp \"\/" . $pName . "\"\/d  $fileName");
            shell_exec("echo " . $pName . ": " . $lastValue + 1 . " >> " . $fileName);
        }
    }
}
