<?php
/**
 * strpos for arrays.
 * @param  [array] $haystack    [What we are looking for]
 * @param  [array]  $needles    [The array we're searching]
 * @return [boolean]            [True or False if we found it]
 */
function strposa($haystack, $needles = array())
{
    $result = array();
    foreach ($needles as $needle) {
        $res = strpos($haystack, $needle);
        if ($res !== false) {
            $result[$needle] = $res;
        }
    }

    if (empty($result)) {
        return false;
    }

    return min($result);
}

/**
 * Echo's a notice at the top of the page.
 * @param  [string] $message [The message that is going to be displayed]
 * @param  [string] $class   [An additional class can be passed in]
 * @return none
 */
function download_notice($message, $class = null)
{
    echo '<div class="download-notice ' . $class . '"><div class="download-notice-message"><p>' . $message . '<span class="close-download-notice">X</span></p></div></div>';
}

/**
 * Returns the translated role of the current user. If that user has
 * no role for the current blog, it returns false.
 *
 * @return string The name of the current role
 **/
function get_current_user_role()
{
    global $wp_roles;
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $role = array_shift($roles);
    return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role]) : false;
}

function dl_user_has_role($check_role)
{
    foreach ($check_role as $role) {
        if (current_user_can($role)) {
            return true;
        }
    }

    return false;
}

/**
 * Get and handle the download link
 * @param  [int] $post_id    [The post ID]
 * @return [string]            [The URL for the download]
 */
function get_the_download_link($post_id, $display_button = true)
{
    if ($display_button == 'true') {
        $output = '<a href="/?do-download=' . $post_id . '" class="download-link btn btn-primary"><i class="fa fa-download" style="vertical-align:-3%;"></i>&nbsp;&nbsp;Download (' . get_post_meta($post_id, 'download_size', true) . ')</a>';
    } else {
        $output = '<a href="/?do-download=' . $post_id . '" class="download-link" target="_blank"><i class="fa fa-download" style="vertical-align:-3%;"></i>&nbsp;&nbsp;' . get_the_title($post_id) . ' (' . get_post_meta($post_id, 'download_size', true) . ')</a>';
    }

    return $output;
}

/**
 * Echo out result of get_the_download_link
 * @param  [int] $post_id    [The post ID]
 * @return [string]            [The URL for the download]
 */
function the_download_link($post_id, $display_button)
{
    echo get_the_download_link($post_id);
}

/**
 * Echo out result of get_the_download_link
 * @param  [int] $post_id    [The post ID]
 * @return [string]            [The URL for the release notes]
 */
function release_notes_btn($post_id)
{
    $release_notes = get_post_meta($post_id, 'download_release_notes', true);
    $notes_btn = '<a href="' . get_permalink($release_notes) . '" class="btn btn-default"><i class="fa fa-info-circle"></i> Release Notes</a>';
    return $notes_btn;
}


/**
 * returns a link to send the user to accept the terms.
 * @param  int $terms_id [The terms post_id]
 * @param  int $download_id [The download post_id]
 */
function get_the_terms_link($license_id, $download_id)
{
    return '<p><i class="fa fa-download" style="vertical-align:-3%;"></i>&nbsp;&nbsp;' . get_the_title($download_id) . ' - <a href="' . get_permalink($license_id) . '?redirect_to=' . get_permalink($download_id) . '">Accept Terms & Request Download</a>.</p>';
}

/**
 * Outputs a link to send the user to accept the terms.
 * @param  int $terms_id [The terms post_id]
 * @param  int $download_id [The download post_id]
 */
function the_terms_link($license_id, $download_id)
{
    echo get_the_terms_link($license_id, $download_id);
}

/**
 * Get a register or login link for the site
 */

function get_the_registration_link($download_id)
{
    return '<i class="fa fa-download" style="vertical-align:-3%;"></i>&nbsp;&nbsp;Please <a href="' . site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()) . '">Register</a> or <a href="' . wp_login_url(get_permalink()) . '">login</a> to download ' . get_the_title($download_id) . '.';
}

/**
 * Output a register or login link for the site
 */
function the_registration_link()
{
    echo the_registration_link();
}

function standard_intended_use_description_guide()
{

    $rmString = '<div class="alert alert-info" role="alert">This download requires you to let us know your areas of interest relating to the download you are requesting along with your intended use case. <br><strong>Please use the box below and type in English.</strong></div>';

    return $rmString;
}

function iup_intended_use_description_guide()
{

    $rmString = '<div class="row">';
    $rmString .= '<div class="col-sm-12"><h4>Examples of what we would like to know...</h4></div>';
    $rmString .= '</div>';
    $rmString .= '<div class="row"><div class="col-sm-12">';
    $rmString .= '<strong>for Student Projects:</strong><br>';
    $rmString .= 'What kind of project is it? ';
    $rmString .= 'What is your student level? ';
    $rmString .= 'The project timing? ';
    $rmString .= 'The expected output?';
    $rmString .= '</div></div><br>';
    $rmString .= '<div class="row"><div class="col-sm-12">';
    $rmString .= '<strong>for Teaching Lab:</strong><br>';
    $rmString .= 'Focused on what topics?<br>';
    $rmString .= 'For students in which discipline and at what academic level?<br>';
    $rmString .= 'The number of students taking the lab each year?<br>';
    $rmString .= 'Which platforms and software do you plan to use?<br>';
    $rmString .= 'Will you publish your results and share them with us?<br>';
    $rmString .= '</div></div>';

    return $rmString;
}

/**
 * @param  int $download_id [The download post_id]
 */
function example_notes()
{

    global $current_user;

    get_currentuserinfo();

    if (
        user_can($current_user, 'editor')
        ||
        user_can($current_user, 'author')
        ||
        user_can($current_user, 'contributor')
        ||
        user_can($current_user, 'subscriber')
        ||
        user_can($current_user, 'university')
    ) {

        $description = standard_intended_use_description_guide();

    }

    return $description;

}

/**
 * The link for a user to request the download
 * @param  [int] $download_id [Download post_id]
 */
function get_the_request_download_link($download_id)
{

    if (get_post_meta($download_id, 'iup_package', true) !== '') {
        $added_description = iup_intended_use_description_guide();
    }

    $form =
        '<form id="download-request-form" action="' . site_url('/wp-admin/admin-post.php') . '" method="POST">
	<input type="hidden" name="action" value="request_download">
	<input type="hidden" name="download-id" value="' . $download_id . '">
	<input type="hidden" name="redirect-to" value="' . get_permalink($download_id) . '">
	<p>
	<label for="describe-intended-use-userentry" class="label-large-default" style="margin-left:-10px;"><span class="label-large-red">' . example_notes() . $added_description . '</span>
	</label>';
    $form .= '<script>
		function textCounter(field, countfield, maxlimit){
			if(field.value.length > maxlimit){
				field.value = field.value.substring(0, maxlimit);
				field.blur();
				field.focus();
				return false;
			} else {
				countfield.value = maxlimit - field.value.length;
			}
		}
	</script>';
    $form .= '<span class="intended-use-validation-message"></span>
	<textarea class="form-control" id="describe-intended-use-userentry" name="describe-intended-use-userentry" rows="5" cols="60" required="true"
	 placeholder="Please use this box to tell us your areas of interest relating to this download request and your intended use case"
	 onblur="textCounter(this,this.form.counter,5000);" onkeyup="textCounter(this,this.form.counter,5000);"
	></textarea><br>
	<input onblur="textCounter(this.form.recipients,this,5000);" disabled onfocus="this.blur();" tabindex="999" maxlength="4" size="4" value="5000" name="counter" style="border: none; background: none;" > characters remaining
	</p>
	<input type="submit" value="Request Download" class="download-request-submit btn btn-primary">
	</form>';

    return $form;
}

/**
 * Output the link for a user to request the download
 * @param  [int] $download_id [Download post_id]
 */
function the_request_download_link($download_id)
{
    echo get_the_request_download_link($download_id);
}

/**
 * Process the agreement
 */
function process_agreement()
{
    if (isset($_POST['submitted']) &&
        isset($_POST['agreement_nonce_field']) &&
        wp_verify_nonce($_POST['agreement_nonce_field'], 'agreement_nonce')
    ) {
        global $post;
        $agreement_type = 'agreed_' . $post->post_name;

        // Store in the session that the user has accepted the terms
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            update_user_meta($user_id, $agreement_type, true);
        } else {
            setcookie($agreement_type, true, time() + MONTH_IN_SECONDS, SITECOOKIEPATH, COOKIE_DOMAIN);
        }

        // Redirect them back to the referer
        if (isset($_GET['redirect_to'])) {
            wp_redirect($_REQUEST['redirect_to']);
            exit();
        }
    }
}

add_action('template_redirect', 'process_agreement', 5);

/**
 * Checks if a user is whitelisted
 */
function whitelist_check($user_id = null)
{
    // If we don't have a user ID use the current user if possible
    if (!$user_id && is_user_logged_in()) {
        $user_id = get_current_user_id();
    } else {
        return false;
    }

    // Get our list of allowed email domains
    $download_whitelist = get_option('download_whitelist');

    // Return false if we don't have a whitelist.
    if (!$download_whitelist) {
        return false;
    }

    // Get the user email address domain
    $user = get_userdata($user_id);
    $email_domain = substr($user->user_email, strpos($user->user_email, "@"));

    // If they are  whitelisted let them through
    if (in_array($email_domain, $download_whitelist)) {
        return true;
    } else {
        return false;
    }
}

/**
 * get the link that's needed for the user for this download.
 * @param  [int] $download_id [The download id post type]
 */
function show_download_link($download_id, $display_button)
{
    // Check if user needs to be logged in
    if (get_post_meta($download_id, 'download_login_required', true)) {
        // Check user is logged in
        if (is_user_logged_in()) {
            // If they are whitelisted or an admin let them them download
            if (whitelist_check() || current_user_can('edit_posts')) {
                return get_the_download_link($download_id, $display_button);
            }

            // Check allowed user group settings
            $allowed_groups = get_post_meta($download_id, 'download_user_roles_allowed', true);
            if (empty($allowed_groups)) {
                // Do they need to agree to anything
                if (license_check($download_id)) {
                    // Do they need to request the download

                    $approval_result = check_approval($download_id);
                    if ($approval_result['status'] == true) {
                        // Let them download the file
                        return get_the_download_link($download_id, $display_button);
                    } else {
                        return $approval_result['message'];
                    }
                } else {
                    // They still need to sign the terms
                    $license_id = get_post_meta($download_id, 'download_agreement_needed', true);
                    return get_the_terms_link($license_id, $download_id);
                }
            } elseif (is_array($allowed_groups) && dl_user_has_role($allowed_groups)) {
                // Do they need to agree to anything
                if (license_check($download_id)) {
                    // Do they need to request the download
                    $approval_result = check_approval($download_id);
                    if ($approval_result['status'] == true) {
                        // Let them download the file
                        return get_the_download_link($download_id, $display_button);
                    } else {
                        return $approval_result['message'];
                    }
                } else {
                    // They still need to sign the terms
                    $license_id = get_post_meta($download_id, 'download_agreement_needed', true);
                    return get_the_terms_link($license_id, $download_id);
                }
            } else {
                $iup_package = get_post_meta($download_id, 'iup_package', true);
                // wrong user group
                if (get_current_user_role() == 'Subscriber' && $iup_package !== '') {
                    return '<p class="alert alert-warning" role="alert"><strong>You need to sign up to the <a href="' . esc_url(home_url('/university/university-registration/')) . '" target="_blank" class="alert-link"> Imagination University Programme</a> to be able to download ' . get_post_meta($download_id, 'download_title', true) . '</strong>.</p>';
                } else {
                    return '<p class="alert alert-warning" role="alert"><strong>Your account type of ' . get_current_user_role() . ' does not have access to ' . get_post_meta($download_id, 'download_title', true) . '</strong>.</p>';
                }
            }
        } else {
            // Register or log in
            //return get_the_registration_link();
            ;
            return get_the_registration_link($download_id);
        }
    } else {
        // Do they need to agree to anything?
        if (license_check($download_id)) {
            // Let them download the file
            return get_the_download_link($download_id, $display_button);
        } else {
            // Make them sign the  terms
            $license_id = get_post_meta($download_id, 'download_agreement_needed', true);
            return get_the_terms_link($license_id, $download_id);
        }
    }
}

/**
 * output the link that's needed for the user for this download.
 * @param  [int] $download_id [The download id post type]
 */
function show_the_download_link($download_id, $display_button)
{
    echo show_download_link($download_id, $display_button);
}


/**
 * output the link that's needed to get more info on this download.
 * @param  [int] $download_id [The download id post type]
 */
function show_more_info($download_id)
{

    $slug = get_post_meta($download_id, 'download_title', 1);
    $slug = preg_replace('/\s/', '-', $slug);
    $slug = strtolower($slug);

    $more_info_btn = '<a class="btn btn-default download-info-button" href="' . site_url('/downloads/') . $slug . '"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;More Info</a>';

    if (get_post_meta($download_id, 'download_description', true) || get_post_meta($download_id, 'download_release_notes', true)) {
        return $more_info_btn;
    }
}


/**
 * Check the downloads and users access settings
 * @param  [int] $download_id [Download post_id]
 */
function check_approval($download_id)
{
    if (get_post_meta($download_id, 'needs_approval', true)) {
        $result = array('status' => false);

        // Get the array of requests
        $download_requests = get_user_meta(get_current_user_id(), 'download_requests', true);

        // Get package name
        $download_title = get_post_meta($download_id, 'download_title', true);

        // Get correct admin email
        $approval_email = get_post_meta($download_id, 'approval_email', true);
        if ($approval_email !== '') {
            $email_list = '';
            if (is_array($approval_email)) {
                if ($approval_email != '') {
                    foreach ($approval_email as $admin_emails) {
                        $email_list .= $admin_emails . "; ";
                    }
                }
            };
            $from_admin_email = $email_list;
        } else {
            $from_admin_email = get_bloginfo('admin_email');
        }

        // Get the status of the request
        if (is_array($download_requests)) {
            $status_check = $download_requests[$download_id]['download_status'];
        } else {
            $status_check = null;
        }

        switch ($status_check) {
            case 'pending':
                $result['message'] = '<p class="alert alert-info" role="alert"><strong>Your download request is awaiting approval.</strong><br>We aim to approve all download requests within 3 working days.</p>';
                break;

            case 'denied':
                $result['message'] = '<p class="alert alert-danger" role="alert"><strong>Sorry your request to download this file was denied.</strong><br>Please <a href="mailto:' . $from_admin_email . '?subject=Why was my request denied for ' . $download_title . '?" class="alert-link">contact an administrator</a> if you wish to know why.</p>';
                break;

            case 'accepted':
                $result['status'] = true;
                break;

            default:
                $result['message'] = get_the_request_download_link($download_id);
                break;
        }
    } else {
        $result = array('status' => true);
    }

    return $result;
}

/**
 * Check the user has accepted the license
 * @param  [int] $download_id [Download post_id]
 */
function license_check($download_id)
{
    // Do they need to agree to terms?
    if ($license_id = get_post_meta($download_id, 'download_agreement_needed', true)) {
        $license_slug = 'agreed_' . get_post_field('post_name', $license_id);
        if (is_user_logged_in()) {
            // Have they accepted the terms?
            if (get_user_meta(get_current_user_id(), $license_slug, true)) {
                // Let them download the file
                return true;
            } else {
                // Send them a link to the terms
                return false;
            }
        } else {
            if ($_COOKIE[$license_slug]) {
                // Let them download the file
                return true;
            } else {
                // Send them a link to the terms
                return false;
            }
        }
    } else {
        // They don't need to sign terms
        return true;
    }
}

/**
 * Check the user has given us their intended use for download
 * @param  [int] $download_id [Download post_id]
 */
function intended_use_check($download_id)
{
    // Do they need to describe their intended use for this download?
    if ($intention = get_post_meta($download_id, 'describe_intended_use', true)) {
        // Have they given us a description of their intended use?
        if (get_post_meta($download_id, 'describe_intended_use_userentry', true)) {
            // they've given a description, allow the download
            return true;
        } else {
            // they haven't told us their intention, don't allow the downloand
            return false;
        }
    } else {
        // a description is not needed
        return true;
    }
}

/**
 * Outputs a table of all the requests
 * @param  [array] $requests [Array of all the requests to throw in a table]
 */
function output_requests_table($requests)
{
    $request_status = strtolower($requests['status']);
    ?>
    <table class="download-request-<?php echo $request_status; ?> table table-hover">
        <thead>
        <th width="6%">Date/Time</th>
        <th width="6%">User Name</th>
        <th width="16%">Email address</th>
        <th width="8%">University</th>
        <th width="6%">Country</th>
        <th width="15%">File Name</th>
        <th width="25%">Intended Use</th>
        <th width="7%">Status</th>
        <th width="11%">Admin</th>
        </thead>
        <tbody>
        <?php
        if (count($requests['results']) > 0) {
            foreach ($requests['results'] as $key => $value) {
                $current_user_ID = $value->ID;
                $current_user_login = $value->user_login;
                $current_user_email = $value->user_email;
                if (function_exists('university_data_retriever')) {
                    $iup_user_info = university_data_retriever($current_user_ID);
                }
                foreach ($value->download_requests as $key => $value) {
                    ?>
                    <tr class="record">
                        <td><?php echo date_i18n('d-m-Y H:i:s', $value['timestamp']); ?></td>
                        <td>
                            <a href="user-edit.php?user_id=<?php echo $current_user_ID; ?>"><?php echo $current_user_login; ?></a>
                        </td>
                        <td><?php echo $current_user_email; ?></td>
                        <td><?php if ($iup_user_info['iup_university_name']) {
                                echo $iup_user_info['iup_university_name'];
                            } ?></td>
                        <td><?php if ($iup_user_info['iup_country']) {
                                echo $iup_user_info['iup_country'];
                            } ?></td>
                        <td class="filename"><a
                                href="post.php?post=<?php echo $value['download_id'] ?>&action=edit"><?php echo get_post_field('post_title', $value['download_id']); ?></a>
                        </td>
                        <td>
                            <?php
                            if ($value['intended_use'] != '') { ?>
                                <div class="iud">
                                <a class="intended-use">Intended Use Description</a>
                                <div class="description"
                                     style="display:none;"><?php echo $value['intended_use']; ?></div>
                                </div><?php
                            }
                            ?>
                        </td>
                        <td>
                            <select name="request-status" data-user="<?php echo $current_user_ID; ?>"
                                    data-request="<?php echo $value['download_id']; ?>">
                                <option value="pending" <?php if ($request_status == 'pending') {
                                    echo 'selected';
                                } ?>>Pending
                                </option>
                                <option value="accepted" <?php if ($request_status == 'accepted') {
                                    echo 'selected';
                                } ?>>Accepted
                                </option>
                                <option value="denied" <?php if ($request_status == 'denied') {
                                    echo 'selected';
                                } ?>>Denied
                                </option>
                            </select>
                        </td>
                        <td>
                            <?php
                            $admins = get_post_field('approval_email', $value['download_id'], false);
                            if (is_array($admins)) {
                                foreach ($admins as $admin) {
                                    echo '<a href="mailto:' . $admin . '">' . $admin . '</a><br>';
                                }
                            } else {
                                echo get_post_field('approval_email', $value['download_id']);
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <td class="empty" colspan="5">There are no <?php echo strtolower($request_status); ?> requests.</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}

/**
 * Change the download request status of a user
 * @return [String] [A JSON array of the status change for a user]
 */
function change_request_download_status()
{

    $user_id = $_POST['user_id'];
    $download_id = $_POST['download_id'];
    $status = $_POST['new_status'];

    $statuses = array('new_status' => $status);

    if (empty($user_id) || empty($download_id)) {
        wp_send_json_error('error');
    }

    $download_requests = get_user_meta($user_id, 'download_requests', true);

    $statuses['old_status'] = $download_requests[$download_id]['download_status'];

    $download_requests[$download_id]['download_status'] = $status;

    update_user_meta($user_id, 'download_requests', $download_requests);

    do_action('request_' . $status . '_notice', $user_id, $download_id);

    wp_send_json(json_encode($statuses));
    die();
}

add_action('wp_ajax_download_request_change', 'change_request_download_status');

/**
 * Email the user that their request has been accepted
 * @param  [int] $user_id     [The user ID]
 * @param  [int] $download_id [The download ID]
 */
function request_accepted_email($user_id, $download_id)
{
    $user = get_userdata($user_id);
    $download_title = get_the_title($download_id);

    if (get_post_meta($download_id, 'iup_package', true) !== '') {
        $headers = 'From: Imagination University Programme <iup@imgtec.com>';
    } else {
        $headers = 'From: ' . get_bloginfo('admin_email');
    };

    $subject = 'Download request has been accepted';

    $message = '<p>Hi ' . $user->user_firstname . ' ' . $user->lastname . '</p>';
    $message .= '<p>Your download request for ' . get_the_title($download_id) . ' has been accepted.</p>';
    $message .= '<p>To download the file <a href="' . get_permalink($download_id) . '" target="_blank">click here</a></p>';

    if (get_post_meta($download_id, 'iup_package', true) !== '') {
        $message .= '<p>We encourage you to share your feedback with us on the Community Forums:</p>';
        $message .= '<ul><li><a href="https://community.imgtec.com/forums/cat/mips-insider/mipsfpga/" >MIPSfpga</a></li>
					 <li><a href="https://community.imgtec.com/forums/cat/mips-insider/connected-microcontroller-lab/" >Connected Microcontroller</a></li>
					 <li><a href="https://community.imgtec.com/forums/cat/powervr-insider-graphics/" >PowerVR Insider</a></li></ul>';
        $message .= '<p>Curriculum development and other topics about support for academia can be posted <a href="https://community.imgtec.com/forums/cat/university/">here</a>.</p>';
        $message .= '<p>There are useful video tutorials and information sheet about each teaching packages on the <a href="https://community.imgtec.com/university/resources/" >teaching resource page</a>.</p>';
        $message .= '<p>Please keep in touch and let us know how your project or new course develops.</p>';
        $message .= '<p>Wishing you lots of success, we are yours faithfully,</p>';
        $message .= '<p>The University Programme Team</p>';
    }

    add_filter('wp_mail_content_type', 'set_mail_as_html');
    wp_mail($user->user_email, $subject, $message, $headers);
    remove_filter('wp_mail_content_type', 'set_mail_as_html');

}

add_action('request_accepted_notice', 'request_accepted_email', 10, 2);

/**
 * Email the user that their request has been denied
 * @param  [int] $user_id     [The user ID]
 * @param  [int] $download_id [The download ID]
 */
function request_denied_email($user_id, $download_id)
{
    $user = get_userdata($user_id);
    $download_title = get_the_title($download_id);

    if (get_post_meta($download_id, 'iup_package', true)) {
        $headers = 'From: Imagination University Programme <iup@imgtec.com>';
    } else {
        $headers = 'From: ' . get_bloginfo('admin_email');
    };

    $subject = 'Download request has been denied';

    $message = '<p>Hi ' . $user->user_firstname . ' ' . $user->lastname . '</p>';
    $message .= '<p>Your download request for ' . get_the_title($download_id) . ' has been denied.</p>';
    if (get_post_meta($download_id, 'iup_package', true)) {
        $message .= '<p>The possible reasons are:</p>';
        $message .= '<ul><li>Your registration details are incomplete or appear untrustworthy</li>
					 <li>You have given little or no details of intended use (we asked for details of labs and student projects)</li>
					 <li>It appears that the request is for commercial use or for a competitor</li></ul>';
        $message .= '<p>If you feel this action is unfair, you can click “reply” to this e-mail and let us know why.</p>';
        $message .= '<p>If we agree with you, it is likely we will ask you to update your registration to ensure it is complete and truthful, and to submit a new request with generous details about the intended use.</p>';
        $message .= '<p>Yours faithfully,</p>';
        $message .= '<p>The University Programme Team</p>';
    }

    add_filter('wp_mail_content_type', 'set_mail_as_html');
    wp_mail($user->user_email, $subject, $message, $headers);
    remove_filter('wp_mail_content_type', 'set_mail_as_html');

}

add_action('request_denied_notice', 'request_denied_email', 10, 2);

/**
 * Email the user that their request has been moved to pending
 * @param  [int] $user_id     [The user ID]
 * @param  [int] $download_id [The download ID]
 */
function request_pending_email($user_id, $download_id)
{
    $user = get_userdata($user_id);
    $download_title = get_the_title($download_id);

    if (get_post_meta($download_id, 'iup_package', true)) {
        $headers = 'From: Imagination University Programme <iup@imgtec.com>';
    } else {
        $headers = 'From: ' . get_bloginfo('admin_email');
    };

    $subject = 'Download request has been moved to pending';

    $message = '<p>Hi ' . $user->user_firstname . ' ' . $user->lastname . '</p>';
    $message .= '<p>Your download request for ' . get_the_title($download_id) . ' has been moved to pending.</p>';

    add_filter('wp_mail_content_type', 'set_mail_as_html');
    wp_mail($user->user_email, $subject, $message, $headers);
    remove_filter('wp_mail_content_type', 'set_mail_as_html');

}

add_action('request_pending_notice', 'request_pending_email', 10, 2);

/**
 * String needed to change the mail content type to HTML
 */
function set_mail_as_html()
{
    return 'text/html';
}
