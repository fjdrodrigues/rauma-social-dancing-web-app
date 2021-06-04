import { Component } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

@Component({
  selector: 'bachata-dance',
  templateUrl: './bachata-dance.component.html',
  styleUrls: ['./bachata-dance.component.css']
})
export class BachataDanceComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}
