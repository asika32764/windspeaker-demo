/**
 * Part of windspeaker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */
(function($)
{
	"use strict";

	window.WindspeakerEdit = {
		prepareArticleSetting: function(popover)
		{
			var btn = $('.article-setting-button a');
			var setting = $('.article-setting .popover');

			btn.on('click', function(e)
			{
				setting.toggleClass('hide');
				btn.parent('li').toggleClass('active');
			});

			setTimeout(function()
			{
				setting.css('visibility', 'visible');
				setting.addClass('hide');
			}, 1000);
		},

		changed: function(state)
		{
			if (!this.saveButton)
			{
				this.saveButton = $('.article-save-button a');
			}

			var save = this.saveButton;

			if (state)
			{
				save.addClass('changed');
			}
			else
			{
				save.removeClass('changed');
				//save.addClass('light');
				Pace.restart();

				//setTimeout(function()
				//{
				//	save.removeClass('light');
				//}, 500);
			}

			this.change = state;
		},

		isChanged: function()
		{
			return this.change;
		},

		/**
		 * @link http://stackoverflow.com/a/1119324
		 */
		confirmOnPageExit: function ()
		{
			var self = this;

			$(window).on('beforeunload', function(e)
			{
				if (!self.isChanged())
				{
					return;
				}

				// If we haven't been passed the event get the window.event
				e = e || window.event;

				var message = 'This article ha been changed, do yuo want to leave without save?';

				// For IE6-8 and Firefox prior to version 4
				if (e)
				{
					e.returnValue = message;
				}

				// For Chrome, Safari, IE8+ and Opera 12+
				return message;
			});
		},

		save: function(url)
		{
			var self = this;
			var form = $('#adminForm');

			var sections = $('.article-setting, .dashboard-header, .hidden-inputs');
			var inputs = sections.find('input, textarea, select');

			if (!form.valid())
			{
				return false;
			}

			var data = {post: {}};

			inputs.each(function(i)
			{
				var e = $(this);

				data.post[e.attr('name')] = e.val();
			});

			data.post.text = this.editor.getValue();

			$.ajax({
				url: url,
				data: data,
				type: "POST",
				success: function (data)
				{
					if (data.success)
					{
						$('#post-id').val(data.item.id);
						$('#post-alias').val(data.item.alias);

						self.changed(false);
					}
					else
					{
						alert(data.msg);
					}
				},
				error: function(data)
				{
					alert(data.responseJSON.msg);
					console.log(data);
				}
			});

			return true;
		}
	};
})(jQuery);