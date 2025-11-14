<?php

namespace App\Constants;

class ActivityActions
{
    const LOGIN = 'login';
    const LOGOUT = 'logout';
    const ADD_VISIT = 'add_visit';
    const VIEW_VISIT = 'view_visit';
    const UPDATE_VISIT = 'update_visit';
    const DELETE_VISIT = 'delete_visit';
    const ADD_STUDENT = 'add_student';
    const UPDATE_STUDENT = 'update_student';
    const DELETE_STUDENT = 'delete_student';
    const UPLOAD_DOCUMENT = 'upload_document';
    const FILL_PUBLIC_STUDENT_FORM = 'fill_public_student_form';
    const FILL_PUBLIC_VISIT_FORM = 'fill_public_visit_form';

    public static $descriptions = [
        self::LOGIN => 'User logged in',
        self::LOGOUT => 'User logged out',
        self::ADD_VISIT => 'Added a visit for :student',
        self::VIEW_VISIT => 'View visit for :student',
        self::UPDATE_VISIT => 'Updated visit for :student',
        self::DELETE_VISIT => 'Deleted visit for :student',
        self::ADD_STUDENT => 'Added student :student',
        self::UPDATE_STUDENT => 'Updated student :student',
        self::DELETE_STUDENT => 'Delete student :student',
        self::UPLOAD_DOCUMENT => 'Uploaded document ":document" for :student',
        self::FILL_PUBLIC_STUDENT_FORM => 'Submitted public form for :student',
        self::FILL_PUBLIC_VISIT_FORM => 'submitted public visit form for :student',
    ];
}
