<?php

// Version: 3.0 Alpha 2; Drafts

// profile
$txt['drafts_show'] = 'Show drafts';
$txt['drafts_show_desc'] = 'This area shows you all the drafts you currently have saved. From here you can edit them before posting, or you can remove them';

// misc
$txt['drafts'] = 'Drafts';
$txt['drafts_member'] = 'Drafts of {member}';
$txt['draft_save'] = 'Save draft';
$txt['draft_save_note'] = 'This will save the text of your post, but it will not save attachments, poll or event information.';
$txt['draft_none'] = 'You have no drafts.';
$txt['draft_edit'] = 'Edit draft';
$txt['draft_hide'] = 'Hide drafts';
$txt['draft_delete'] = 'Delete draft';
$txt['draft_saved_on'] = 'Draft last saved {date}';
$txt['draft_last_saved'] = 'Draft last saved <strong>{age, plural,
	one {# day ago}
	other {# days ago}
}</strong>.{remaining, plural,
	=0 {}
	one { This will be retained for <strong># more day</strong>.}
	other { This will be retained for <strong># more days</strong>.}
}';
$txt['draft_remove'] = 'Remove this draft';
$txt['draft_saved'] = 'The contents have been saved as a draft, and will be accessible from the <a href="{url}">Show Drafts area</a> of your profile.';
$txt['draft_pm_saved'] = 'The contents have been saved as a draft, and will be accessible from the <a href="{url}">Show Drafts area</a> of your message center.';
$txt['draft_save_warning'] = 'Please note that all drafts will be automatically deleted {0, plural,
	one {after # day}
	other {after # days}
}.';

// Admin options
$txt['drafts_autosave_enabled'] = 'Enable automatic saving of drafts';
$txt['drafts_autosave_enabled_subnote'] = 'This will automatically save user drafts in the background on a given frequency. The user must also have the proper permissions';
$txt['drafts_show_saved_enabled'] = 'Enable the selection of drafts from the posting screen';
$txt['drafts_show_saved_enabled_subnote'] = 'This will allow the user to select and load appropriate drafts from the posting screen. The user must also have the proper permissions';
$txt['drafts_keep_days'] = 'Maximum number of days to keep a draft';
$txt['drafts_keep_days_subnote'] = 'Enter 0 to keep drafts indefinitely';
$txt['drafts_autosave_frequency'] = 'How often should drafts be autosaved?';
$txt['drafts_autosave_frequency_subnote'] = 'The minimum allowable value is 30 seconds';
$txt['drafts_pm_enabled'] = 'Enable the saving of PM drafts';
$txt['drafts_post_enabled'] = 'Enable the saving of Post drafts';
$txt['drafts_none'] = 'No subject';
$txt['drafts_saved'] = 'Draft was successfully saved';

?>