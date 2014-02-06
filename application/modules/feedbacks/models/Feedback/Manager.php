<?php

/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Feedbacks_Model_Feedback_Manager extends Core_Model_Manager
{

    public function saveFeedback($data)
    {
        $data = array(
            'feedback_username' => $data['login'],
            'feedback_email' => $data['email'],
            'feedback_message' => $data['textarea'],
            'feedback_status' => '1',
            'feedback_answer' => NULL,

        );
        $feedback = $this->getDbTable()->createRow($data);
        if ($feedback->save()) {
            return $feedback;
        }
        return false;
    }

    public function showFeedback()
    {
        $select = $this->getDbTable()->select()
            ->from(array('feedbacks'), array('feedback_username', 'feedback_email', 'feedback_message', 'feedback_answer'))
            ->where('feedback_status = ?', 'public');

        return $this->getDbTable()->fetchAll($select)->toArray();

    }


}