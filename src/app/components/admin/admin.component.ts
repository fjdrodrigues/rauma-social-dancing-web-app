import { Component, Output, EventEmitter, OnInit } from '@angular/core';

import { PostService } from '../../services/post.service';
import { ActivityService } from '../../services/activity.service';


@Component({
  selector: 'admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent  implements OnInit {

  constructor(private postService: PostService,
              private activityService: ActivityService) {
  }
	
	ngOnInit() {

  }
}
