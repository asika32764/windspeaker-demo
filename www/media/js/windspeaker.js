/**
 * Part of windspeaker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */
(function($)
{
	"use strict";

	window.Windspeaker = {
		post: function (url, method)
		{
			method = method || 'post';

			var form = $('#adminForm'),
				methodInput = $('#adminForm input[name="_method"]');

			if(!methodInput.length)
			{
				methodInput = $('<input name="_method" type="hidden">');

				form.append(methodInput);
			}

			methodInput.val(method);
			form.attr('action', url).attr('method', 'post');

			form.submit();

			return true;
		},

		deleteItem: function(url, msg)
		{
			msg = msg || 'Are you sure?';

			if (!confirm(msg))
			{
				return false;
			}

			return this.post(url, 'delete');
		}
		/*
		,

		thumbAvatar: function(selector, size)
		{
			size = size || 48;

			$('.selector').each(function()
			{
				var img = window.jsthumb.resize(this, {maxWidth: size, maxHeight: size});

				$(this).attr('src', img);
			});
		}
		*/
	};
})(jQuery);