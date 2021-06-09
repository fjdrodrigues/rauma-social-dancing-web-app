import { Component, HostListener, OnInit } from '@angular/core';
import { Scroll } from '@angular/router';

import { PostService } from '../../services/post.service';

import { BasePostComponent } from '../shared/base-post/base-post.component';

@Component({
  selector: 'about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})
export class AboutComponent extends BasePostComponent {
	
  constructor(protected postService: PostService) {
	  super(postService);
  }

  ngOnInit() {
    this.applyStyleToDescriptions();
  }

  public applyStyleToDescriptions(): void {
    let descriptions = document.getElementsByClassName("teacher-description");
    for(let i = 0; i < descriptions.length; i++) {
      let htmlDescription = descriptions.item(i) as HTMLElement;
      if (htmlDescription.clientWidth < htmlDescription.scrollWidth || htmlDescription.clientHeight
        < htmlDescription.scrollHeight) {
        htmlDescription.style.paddingRight = "5px";
        htmlDescription.style.boxShadow = "inset 0 -12px 10px -7px #31343f66";
      } else {
        htmlDescription.style.paddingRight = "none";
        htmlDescription.style.boxShadow = "none";
      }
    }
  }

  @HostListener('scroll', ['$event']) onScroll(event: any) {
    if (event.target.scrollTop > 0 && event.target.scrollTop < event.target.scrollHeight - 232) {
      let element = event.target as HTMLDivElement;
      element.style.boxShadow = "inset 0 12px 10px -7px #31343f66, inset 0 -12px 10px -7px #31343f66";
    } else if (event.target.scrollTop > 0) {
      let element = event.target as HTMLDivElement;
      element.style.boxShadow = "inset 0 12px 10px -7px #31343f66";
    } else if (event.target.scrollTop <= 0) {
      let element = event.target as HTMLDivElement;
      element.style.boxShadow = "inset 0 -12px 10px -7px #31343f66";
    }
  }

  @HostListener('window:resize', ['$event']) onResize(event : any) {
    this.applyStyleToDescriptions();
  }
	
}