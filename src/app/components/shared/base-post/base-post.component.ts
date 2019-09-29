import { Component, Injectable } from '@angular/core';

import { PostService } from '../../../services/post.service';

@Component({
  selector: 'base-post',
  templateUrl: './base-post.component.html',
  styleUrls: ['./base-post.component.css']
})
export class BasePostComponent {

  constructor(protected postService: PostService) {
	  
  }
}
