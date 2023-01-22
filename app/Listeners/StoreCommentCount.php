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
        $fileName = config('custom.product_comment_counter_file');
        // getting file content with product name
        $output =  shell_exec("awk -F':' '$1 ==\"" . $pName . "\"{print $2}' " . $fileName);

        // converting file content to array
        $result_array = preg_split('/\s+/', trim($output));
        $lastValue = $result_array[count($result_array) - 1];

        // if product is new, it must be inserted into file.
        if ($lastValue == null ) {
            shell_exec("echo " . $pName . ": " . 1 . " >> " . $fileName);
        } else {  // if product is not new, it must be updated into file.
            //  first the line with that product should be removed.
            shell_exec("echo amiralimac | sudo -S sed -i.bkp \"\/" . $pName . "\"\/d  $fileName");
            // then new line should be inserted with increased comment count by one.
            shell_exec("echo " . $pName . ": " . $lastValue + 1 . " >> " . $fileName);
        }
    }
}
