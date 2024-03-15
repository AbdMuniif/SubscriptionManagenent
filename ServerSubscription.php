<?php

namespace SubscriptionManagement;

class User {
    public $name;
    private $subscriptionPlan;
    
    public function __construct() {
        $this->subscriptionPlan = null;
    }
    
    
    public function subscribe(SubscribeInterface $plan) {
        $this->subscriptionPlan = $plan;
    }
    
    public function unsubscribe() {
        $this->subscriptionPlan = null;
    }
         
    public function connectServer(Server $server) {
        
        if($this->subscriptionPlan && $this->subscriptionPlan->canConnect()) {
            echo "{$this->name} is connected to {$server->name} successfully\n\n";
        } else {
            echo "Error: Cannot connect to server ";
        }
    }
}

Class Server {
    public $name;
    public $ipAddress;
    }
    
    interface SubscribeInterface{
        public function canConnect();
        }
        
    abstract class Plan implements SubscribeInterface {
        abstract public function canConnect();
        }
        
    class BasicPlan extends Plan{
        public function canConnect(){
        return true;
        }
}
    class ProPlan extends Plan{
        public function canConnect(){
        return true;
        } 
}
        
        


// Execution
print "\n\nOOP Practice !\n\n";

// Setting up required details
$user = new User();
$user->name = 'Haziq Zahari';

$server_1 = new Server();
$server_1->name = 'Server 1';
$server_1->ipAddress = '192.168.0.1';

$server_2 = new Server();
$server_2->name = 'Server 2';
$server_2->ipAddress = '192.168.0.2';

// Flow 1 - Basic Plan
print "Flow #1 Basic Plan Subscription !\n\n";
$user->subscribe(new BasicPlan());

$user->connectServer($server_1);
$user->connectServer($server_2); // fail

// Flow 2 - Pro/Business Plan
print "Flow #2 Upgrade Plan Subscription !\n\n";
$user->subscribe(new ProPlan());
$user->connectServer($server_2); // success

// Flow 3 - Unsubscribe
print "Flow #3 Unsubscribe Plan Subscription !\n\n";
$user->unsubscribe();
$user->connectServer($server_2); // fail

?>