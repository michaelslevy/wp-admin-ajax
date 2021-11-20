import React, { Component } from 'react';
import $ from 'jquery';

class WpAdminForm extends Component {
	
	constructor(props) {
      super(props);
      this.state = {
         value: "",
      }
	  this.handleChange = this.handleChange.bind(this);
   }
	
	componentDidMount(){
		
		const $this=this;
		const ajaxurl = window.ajaxurl;
    		
		var data = {
			'action': 'dlg_load_option'
		};
		
		$.post(ajaxurl, data, function(response) {
			$this.setState({value: response });
		});
	}
	
	handleChange(event) {
		
		const $this=this;
				
		this.setState({value: event.target.value});
		var data = {
				'action': 'DLG_save_option',
				'new_option_name': event.target.value
			};
			
		$.post( window.ajaxurl, data, function(response) {
		})
	}

	render() {

		return (
		   <div>
			   <table class="form-table">
					<tr valign="top">
						<th scope="row">New Option Name <em>from React</em></th>
						<td><input type="text" id="new_option_name" name="new_option_name" value={this.state.value} onChange={this.handleChange} /></td>
					</tr>
				</table>
		   </div>
     );
  }
}

//connects Login component to store
export default WpAdminForm;
