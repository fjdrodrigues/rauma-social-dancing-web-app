import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'cuban-salsa-dance',
  templateUrl: './cuban-salsa-dance.component.html',
  styleUrls: ['./cuban-salsa-dance.component.css']
})
export class CubanSalsaDanceComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
