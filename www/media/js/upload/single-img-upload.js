/**
 * Part of windspeaker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

var SingleImageUpload = {
	/**
	 * Init
	 *
	 * @param options
	 */
	init: function(options)
	{
		var defaultOptions = {
			action: 'upload',
			selector: {
				fileInput:    '#image-file',
				uploadButton: '#upload-btn',
				deleteButton: '#delete-btn',
				image:        '#image-preview',
				itemId:       '#item-id'
			},
			success : function(r){return r;},
			error: function(r){return r;}
		};

		options = $.extend(defaultOptions, options);

		this.fileInput    = $(options.selector.fileInput);
		this.uploadButton = $(options.selector.uploadButton);
		this.deleteButton = $(options.selector.deleteButton);
		this.image        = $(options.selector.image);
		this.itemId       = $(options.selector.itemId);

		this.options = options;

		this.registerEvents();
	},

	registerEvents: function()
	{
		var self = this;

		this.uploadButton.on('click', function(e)
		{
			self.fileInput.click();
		});

		// Upload
		this.fileInput.on('change', function(e)
		{
			var xhr = new XMLHttpRequest();

			var formData = new FormData;

			formData.append('file', self.fileInput[0].files[0]);
			formData.append('id', $(self.options.selector.itemId).val());

			xhr.addEventListener("load", function(ev)
			{
				var response = eval("(" + ev.target.responseText + ")");

				if (response.error)
				{
					console.log('Upload fail');

					return;
				}

				self.image.attr('src', response.file);

				Pace.restart();

				self.options.success(response);
			}, false);

//            xhr.upload.addEventListener("progress", function(ev) {
//                settings.OnProgress(ev.loaded, ev.total);
//            }, false);

			xhr.open("POST", self.options.action, true);
			xhr.send(formData);
		});

		// Delete
		this.deleteButton.on('click', function()
		{
			Pace.restart();

			var data = {id: self.itemId.val(), '_method': 'DELETE'};

			$.ajax({
				url: self.options.action,
				type: 'POST',
				data: data,
				success: function(res)
				{
					if (!res.error)
					{
						self.image.attr('src', res.image);
					}
				}
			});
		});
	}
};
