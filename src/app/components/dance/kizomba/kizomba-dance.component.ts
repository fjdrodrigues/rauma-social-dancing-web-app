import { Component, OnInit } from '@angular/core';

import { PostService } from '../../../services/post.service';

import { BasePostComponent } from '../../shared/base-post/base-post.component';

import { Post } from '../../../domain/post.model';

@Component({
  selector: 'kizomba-dance',
  templateUrl: './kizomba-dance.component.html',
  styleUrls: ['./kizomba-dance.component.css']
})
export class KizombaDanceComponent extends BasePostComponent implements OnInit {
	
	public posts: Post[];
	public post: Post;
	private category = "kizomba";
	
  constructor(protected postService: PostService) {
	  super(postService);
  }
	
	ngOnInit() {
		/*this.postService.getAllFromCategory(this.category).subscribe((posts: Post[]) => {
				this.posts = posts;
			});*/
		this.postService.testPost(1).subscribe((post: Post) => {
			this.post = post;
		});
	}
}
