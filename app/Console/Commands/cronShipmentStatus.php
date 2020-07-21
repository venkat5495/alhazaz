<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Order;
use Mail;

class cronShipmentStatus extends Command
{
    protected $signature = 'notify:ShipmentStatus';
    protected $description = 'Update Status';
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function handle()
    {
        $orderDetail = new Order;
        $orderDetail->delivery_status = 'good';
        $orderDetail->save();
        
        Mail::send(['html' => 'This is test'], function($message){
           $message->from('saurabh@gmail.com');
           $message->subject('This i only for testing subject. Please ignore this.');
           $message->to('sa786bh@gmail.com');
        });
    }
}
?>