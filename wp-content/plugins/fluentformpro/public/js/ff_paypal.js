jQuery(document).ready((function(a){var e=a("body").find(".ff_paypal_delay_loader_check");if(e.length){o();var n=0}function o(){n++,setTimeout(t,window.ff_paypal_vars.timeout)}function t(){a.post(window.ff_paypal_vars.ajax_url,{submission_id:window.ff_paypal_vars.submission_id,action:"fluentform_paypal_delayed_check"}).then((function(t){t.data.nextAction&&"reload"==t.data.nextAction?window.location.reload():n<=5?o():(a(".ff_paypal_loader_svg").remove(),e.html(window.ff_paypal_vars.onFailedMessage))})).catch((function(a){var n="Request failed. Please try again";a.responseJSON?a.responseJSON.data&&(n=a.responseJSON.data.message):n=a.responseText,e.html(n)}))}}));