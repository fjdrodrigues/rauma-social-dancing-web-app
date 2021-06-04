import { Component } from '@angular/core';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})
export class AboutComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}