import { Component } from '@angular/core';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'health',
  templateUrl: './health.component.html',
  styleUrls: ['./health.component.css']
})
export class HealthComponent extends BasePostComponent {

  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
