import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'semba-dance',
  templateUrl: './semba-dance.component.html',
  styleUrls: ['./semba-dance.component.css']
})
export class SembaDanceComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
