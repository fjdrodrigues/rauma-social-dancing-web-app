import { Component } from '@angular/core';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'classes',
  templateUrl: './classes.component.html',
  styleUrls: ['./classes.component.css']
})
export class ClassesComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
}