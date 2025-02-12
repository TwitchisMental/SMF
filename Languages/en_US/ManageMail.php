<?php

// Version: 3.0 Alpha 2; ManageMail

$txt['mailqueue_desc'] = 'From this page you can configure your mail settings, as well as view and administer the current mail queue.';

$txt['mail_type'] = 'Mail type';
$txt['mail_type_default'] = '(PHP default)';
$txt['smtp_host'] = 'SMTP server';
$txt['smtp_port'] = 'SMTP port';
$txt['smtp_username'] = 'SMTP username';
$txt['smtp_password'] = 'SMTP password';

$txt['mail_limit'] = 'Maximum emails to send per minute';
$txt['mail_quantity'] = 'Maximum amount of emails to send per page load';

$txt['mailqueue_stats'] = 'Mail queue statistics';
$txt['mailqueue_oldest'] = 'Oldest Mail';
$txt['mailqueue_oldest_not_available'] = 'N/A';
$txt['mailqueue_size'] = 'Queue length';

$txt['mailqueue_age'] = 'Age';
$txt['mailqueue_priority'] = 'Priority';
$txt['mailqueue_recipient'] = 'Recipient';
$txt['mailqueue_subject'] = 'Subject';
$txt['mailqueue_clear_list'] = 'Send mail queue now';
$txt['mailqueue_no_items'] = 'The mail queue is currently empty';
$txt['personal_message'] = 'Personal Message';
// Do not use numeric entities in below string.
$txt['mailqueue_clear_list_warning'] = 'Are you sure you wish to send the whole mail queue now? This will override any limits you have set.';

$txt['mq_age'] = '{unit, select,
	day {{age, plural,
		one {# day}
		other {# days}
	}}
	hour {{age, plural,
		one {# hour}
		other {# hours}
	}}
	minute {{age, plural,
		one {# minute}
		other {# minutes}
	}}
	second {{age, plural,
		one {# second}
		other {# seconds}
	}}
	other {{age, plural,
		one {# {unit}}
		other {# {unit}}
	}}
}';

$txt['mq_mpriority_5'] = 'Very Low';
$txt['mq_mpriority_4'] = 'Low';
$txt['mq_mpriority_3'] = 'Normal';
$txt['mq_mpriority_2'] = 'High';
$txt['mq_mpriority_1'] = 'Very High';

$txt['birthday_email'] = 'Birthday message to use';
$txt['birthday_body'] = 'Email body';
$txt['birthday_subject'] = 'Email subject';

$txt['mailtest_header'] = 'Email Test';
$txt['mailtest_result_success'] = 'Successfully sent a test message';
$txt['mailtest_result_failure'] = 'Unable to send a test message, check the <a href="{url}">error log</a> for more information.';

?>