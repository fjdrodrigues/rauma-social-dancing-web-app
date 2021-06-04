import { Component } from '@angular/core';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'contacts',
  templateUrl: './contacts.component.html',
  styleUrls: ['./contacts.component.css']
})
export class ContactsComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}