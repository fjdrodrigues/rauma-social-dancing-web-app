import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'body-health',
  templateUrl: './body-health.component.html',
  styleUrls: ['./body-health.component.css']
})
export class BodyHealthComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
