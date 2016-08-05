<h2>Subscribe to Mailchimp</h2>
<?php
    echo $this->Form->create('MailchimpSubscriber', array('action' => 'test'));

    echo $this->Form->input('id');
    echo $this->Form->input('emailaddress');
    echo $this->Form->input('FNAME');
    echo $this->Form->input('LNAME');
    //echo $this->Form->input('GENDER');
    echo $this->Form->end('Submit');
?>