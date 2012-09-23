function split(val) {
	return val.split( /,\s*/ );
}
function extractLast(term) {
	return split(term).pop();
}
var VMT = { Module: {} };

VMT.Module.Autocomplete = function(){
	var _field, _response, _vols = [];
	return {
		init: function(){
			var _field = $("input[name=_tmp_name]");
			if (_field.size()) {
				$.ajax({
					url: "/api/users",
					success: function(data){
						_response = data;
						for (d in data) {
							var _vol = data[d];
							_vols.push(_vol.full_name);
						}
						_field.bind( "keydown", function( event ) {
							if ( event.keyCode === $.ui.keyCode.TAB &&
									$( this ).data( "autocomplete" ).menu.active ) {
								event.preventDefault();
							}
						}).autocomplete({
							minLength: 0,
							source: function(request, response){
								// delegate back to autocomplete, but extract the last term
								response( $.ui.autocomplete.filter(
									_vols, extractLast( request.term ) ) );						
							},
							select: function(event, ui) {
								var terms = split( this.value );
								// remove the current input
								terms.pop();
								// add the selected item
								terms.push( ui.item.value );
								// add placeholder to get the comma-and-space at the end
								terms.push( "" );
								this.value = terms.join( ", " );
								var _name = ui.item.value;
								return false;
							},
							focus: function() {
								return false;
							}
						});
					}
				});
			}
		}
	};
}();

VMT.Module.Manager = function(){
	var _rows;

	// mouseover effects on rows
	var _initRows = function(){
		_rows.mouseover(function(){
			$(this).find("td").addClass("hover");
		}).mouseout(function(){
			$(this).find("td").removeClass("hover");
		});
	};
	
	// set up the actions
	var _initActions = function(){
		// bind click event on the rows
		_rows.click(function(ev){
			var _o = $(this), _location;
			var _link = _o.find("a.manage, a.tool");
			if ($(ev.srcElement).attr("type") == "checkbox") {
				return;
			}
			if (_link.size()) {
				_location = _link.attr("href");
			} else {
				var _c = _o.find("input[type=checkbox]");
				_location = "/" + _c.attr("role") + "/" + _c.val();
			}
			if (_location) {
				window.location = _location;
			}
		});
		
		// delete buttons
		$(".delete").click(function(){
			var result = window.confirm("Are you sure you want to delete the selected item(s)?");
			if (!result) {
				return false;
			}
			$("form").submit();
			return false;
		});
		
		// reset buttons
		$("input[type=reset]").click(function(){
			var _base = window.location.href.split("://")[0] + "://" + document.domain;
			var _controller = "/" + window.location.href.replace(_base, "").split("/")[1];
			var _url = _base + _controller;
			window.location = _url;
		});
		
		// checkbox to select all checkboxes
		$("#selector").click(function(){
			var _collection = $("table.index input[type=checkbox]");
			var _o = $(this);
			_collection.each(function(i){
				var _c = $(this);
				if (i > 0) {
					if (!_o.attr("checked")) {
						_c.prop("checked", false);
					} else {
						_c.prop("checked", true);
					}
				}
			});
		});					
	};
	return {
		init: function(){
			_rows = $("table.index tr");
			_initRows();
			_initActions();
		}
	};
}();
VMT.Module.Inbox = function(){
	return {
		init: function(){
			$("table.message").parent("form").submit(function(){
				var _names = $("input[name=_tmp_name]").val().split(", ");
				var _val = [];
				for (n in _names) {
					var _name = _names[n];
					if (_name != "") {
						for (v in _response) {
							var _vol = _response[v];
							if (_vol.full_name == _name) {
								_val.push(_vol.user_id);
								break;
							}
						}
					}
				}
				$("input[name=recipient_id]").val(_val);
			});
		}
	};
}();

$(document).ready(function(){
	for(var _prop in VMT.Module) {
		if (typeof VMT.Module[_prop].init == "function") {
			VMT.Module[_prop].init();
		}
	}
});