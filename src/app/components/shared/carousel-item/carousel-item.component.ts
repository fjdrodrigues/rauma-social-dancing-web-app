import { Component, ElementRef, Input } from "@angular/core";

@Component({
  selector: 'adk-carousel-item',
  templateUrl: './carousel-item.component.html',
  styleUrls: ['./carousel-item.component.css']
})
export class CarouselItemComponent {
  @Input() itemIndex: number;
  @Input() imgSrc: string;
  @Input() imgHyperlink: string;
  @Input() title: string;
  @Input() description: string;

  constructor(public elementRef: ElementRef){
    
  }
}