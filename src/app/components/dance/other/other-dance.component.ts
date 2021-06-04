import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'other-dance',
  templateUrl: './other-dance.component.html',
  styleUrls: ['./other-dance.component.css']
})
export class OtherDanceComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
