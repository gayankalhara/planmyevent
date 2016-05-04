<?php

namespace App\Http\Controllers;

use Mail;

class EmailController extends Controller
{

    /**
     * @param $user
     * @param $email
     * @param $quoteID
     */
    public function requestQuoteEmail($user, $email, $quoteID)
    {
        $mailData = [
            'name' => $user,
            'email' => $email,
            'quoteID' => $quoteID
        ];

        //Send Quote Requested Email
        Mail::send('emails.quote_emails.quote-request', $mailData, function($message) use ($email) {
            $message->to($email)
                ->subject('Quote Requested | PlanMyEvent.me');
        });
    }

    /**
     * @param $user
     * @param $email
     * @param $quoteID
     */
    public function quoteApprovedEmail($user, $email, $quoteID)
    {
        $mailData = [
            'name' => $user,
            'email' => $email,
            'quoteID' => $quoteID
        ];

        //Send Quote Approved Email
        Mail::send('emails.quote_emails.approve-quote', $mailData, function($message) use ($email) {
            $message->to($email)
                ->subject('Quote Approved | PlanMyEvent.me');
        });
    }

    /**
     * @param $user
     * @param $email
     * @param $quoteID
     * @param $reason
     * @param $msg
     */
    public function quoteRejectedEmail($user, $email, $quoteID, $reason, $msg)
    {
        $mailData = [
            'name' => $user,
            'email' => $email,
            'quoteID' => $quoteID,
            'reason' => $reason,
            'msg' => $msg
        ];

        //Send Quote Rejected Email
        Mail::send('emails.quote_emails.reject-quote', $mailData, function($message) use ($email) {
            $message->to($email)
                ->subject('Quote Rejected | PlanMyEvent.me');
        });
    }

}