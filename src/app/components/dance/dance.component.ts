import { Component } from '@angular/core';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'dance',
  templateUrl: './dance.component.html',
  styleUrls: ['./dance.component.css']
})
export class DanceComponent extends BasePostComponent {

  constructor(protected postService: PostService) {
	  super(postService);
  }
	
	
}
