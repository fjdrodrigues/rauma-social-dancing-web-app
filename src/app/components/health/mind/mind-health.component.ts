import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'mind-health',
  templateUrl: './mind-health.component.html',
  styleUrls: ['./mind-health.component.css']
})
export class MindHealthComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
