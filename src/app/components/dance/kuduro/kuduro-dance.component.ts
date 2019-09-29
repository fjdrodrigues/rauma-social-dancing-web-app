import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'kuduro-dance',
  templateUrl: './kuduro-dance.component.html',
  styleUrls: ['./kuduro-dance.component.css']
})
export class KuduroDanceComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
