<?php
    /**
     * Summary :- AdminSetting
     */
    
class AdminSetting extends AppModel {
    var $name = 'AdminSetting';
    public $validate = array(
        'min_loan_amount' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter minimum loam amount'
        ),
        'max_loan_amount' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter max loan amount'
        ),
        'fico_score' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter fico score'
        ),
        'processing_fee' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Processing Fee'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Numeric Enter Processing Fee'
            )
        ),
        'origination_fee' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Numeric Origination Fee'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Enter Origination Fee'
            )
        ),
        'sales_director_fee' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Numeric Sales Director Fee'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Enter Sales Director Fee'
            )
        ),
        'processor_fee' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Numeric Processor Fee'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Enter Processor Fee'
            )
        ),
        'funder_fee' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Numeric Funder Fee'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Enter Funder Fee'
            )
        ),
        'rockland_commission' => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Enter Numeric Rockland Commission Percentage'
            ),
            'price' => array(
                'rule' => 'numeric',
                'message' => 'Please Enter Rockland Commission Percentage'
            )
        )
    );
}

?>
